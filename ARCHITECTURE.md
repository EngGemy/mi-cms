# Architecture — SOLID Principles Applied

This document explains the design decisions and how the SOLID principles map to the codebase.

---

## Layered Architecture

```
HTTP / Filament  →  Controllers / Actions  →  Services  →  Models / Eloquent
                                                ↓
                                          Repositories (optional)
                                                ↓
                                            Database
```

### Layer responsibilities

- **Controllers / Filament Resources**: HTTP transport only. Parse input, call Services/Actions, return Response/View.
- **Actions**: Single-purpose write operations (`StoreContactSubmission`, `CreateCalculatorEstimate`). Pattern from Spatie\Larastan/Spatie\Laravel-actions.
- **Services**: Pure business logic. Stateless. Testable in isolation.
- **Models**: Data + relationships only — no business rules, no formatting.

---

## SOLID

### Single Responsibility Principle

Each class has **one** reason to change.

| Class | Responsibility |
|---|---|
| `CalculatorService` | Apply MI's pricing formulas. Knows nothing about HTTP or DB. |
| `CreateCalculatorEstimate` | Persist a calculator request from validated input. |
| `NewsletterService` | Subscribe / confirm / unsubscribe newsletter members. |
| `SeoService` | Build SEO meta arrays from any model. |
| `HomeController` | Compose home page data, return view. No business logic. |
| `BlogPost` model | Define columns, casts, relationships, scopes. No formatting/HTML. |

When the pricing formula changes, only `CalculatorService` is touched. When the spam filter changes, only the contact `Action` is touched.

### Open / Closed Principle

The system is open for extension, closed for modification.

**Example — pricing calculator:**
```php
interface CalculatorServiceInterface {
    public function calculate(float $L, float $W, float $H, int $tiers, int $lines): array;
}
```

To swap pricing logic (e.g. add VAT, change unit costs based on currency), implement a new class. No changes to `Livewire\PriceCalculator` or the Blade view.

**Example — SEO:**

Any model can implement `HasSeoMeta` trait:
```php
class BlogPost extends Model {
    use HasTranslations, HasSeoMeta;
    // ...
}
```

Adding SEO to a new model = one line.

### Liskov Substitution Principle

Subclasses and implementations honor the contract of the base/interface.

`CalculatorService` and any future `VatAwareCalculatorService` both return:
```php
[
    'inputs' => [...],
    'birds' => int,
    'construction' => [...],
    'battery' => [...],
    'accessories' => [...],
    'grand_total' => int,
]
```

The Livewire component and view never need to know which implementation is bound.

### Interface Segregation Principle

Interfaces are small and focused. Clients depend only on what they use.

Instead of one giant `ContentServiceInterface`, we have:
- `CalculatorServiceInterface` (3 methods)
- `SeoServiceInterface` (2 methods)
- `NewsletterServiceInterface` (4 methods)

A controller injecting `SeoServiceInterface` doesn't drag in newsletter dependencies.

### Dependency Inversion Principle

High-level modules don't depend on low-level modules. Both depend on abstractions.

Bound in `AppServiceProvider::register()`:
```php
$this->app->bind(CalculatorServiceInterface::class, CalculatorService::class);
$this->app->bind(SeoServiceInterface::class, SeoService::class);
$this->app->bind(NewsletterServiceInterface::class, NewsletterService::class);
```

Livewire components and controllers type-hint the interface, not the concrete class — Laravel resolves it. Swapping implementations = one line change.

---

## Why these specific decisions

### 1. **JSON-column translations** (vs separate translations table)

Spatie\Translatable stores translations as JSON in the same row. Trade-off:
- ✅ Simpler queries, no joins, fewer migrations
- ✅ Filament 4 has first-class plugin support
- ❌ Harder to query "all posts with English title"
- For our content scale (~hundreds of records, not millions), the simplicity wins.

### 2. **Livewire over Vue/React** (for the calculator)

The calculator needs server-side state (logging requests, server-validated prices). Livewire keeps everything in PHP. No JS bundle for this feature. Reactive enough at typical user input rates.

### 3. **Honeypot fields over CAPTCHA**

`spatie/laravel-honeypot` adds an invisible field bots fill in. Catches >95% of spam without UX friction. CAPTCHA blocks real users.

### 4. **URL-prefixed locale routing**

`/ar/products` vs `/products?lang=ar` because:
- SEO: search engines index separate URLs per language
- Sharing: link includes language context
- No cookie/session dependency

### 5. **`spatie/laravel-medialibrary` over native uploads**

- Automatic image conversions (thumb, medium, large)
- File-system abstraction (swap local → S3 → Cloudinary with config only)
- Strong Filament 4 integration
- Polymorphic `media` table — every model can have associated files

### 6. **Action classes for writes**

`Actions/CreateCalculatorEstimate` instead of writing to DB inside the controller. This means:
- The same action runs from web, API, or console command
- One place to add side effects (email notification, slack alert)
- Trivially testable

### 7. **`config/mi.php` for business constants**

Hard-coded constants are evil. The calculator's unit prices, phone numbers, and locales live in `config/mi.php`, overridable via `.env`. Production deployments swap values without code edits.

---

## What's NOT here (intentional simplification)

- **Repository pattern**: Eloquent IS our repository. Adding `ProductRepository` for `Product::where(...)` is ceremony, not value.
- **CQRS**: Not needed at this content scale.
- **Event sourcing**: Not needed.
- **API**: Domain is the public website + admin. If we need an external API later, it lives in `routes/api.php` reusing the same Services.
- **Microservices**: Single Laravel monolith is the right choice for content of this scale.

---

## Testing strategy

- **Unit tests** for Services (`CalculatorServiceTest`)
- **Feature tests** for HTTP flows (`HomePageTest`)
- **Integration** via Filament's built-in testing helpers when needed
- **Browser tests** with Laravel Dusk for calculator UX (optional)

Tests run against in-memory SQLite (`phpunit.xml` config).

