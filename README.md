# MI Poultry CMS

> Bilingual (Arabic / English) CMS for **MI Automatic Poultry Cages**, built on Laravel 12 + Filament 4.
> Implements the full v10 design as a database-driven application with admin panel, blog, comments, newsletter, SEO, and a sales calculator using MI's pricing formulas.

---

## ✨ Features

- **Bilingual content** — Arabic & English via `spatie/laravel-translatable`; locale switcher with URL prefix (`/ar/...`, `/en/...`)
- **Filament 4 admin** at `/admin` with 16 resources covering every page section
- **Media library** — `spatie/laravel-medialibrary` with automatic image resizing & conversions
- **Blog module** — categories, tags, comments (with moderation), newsletter signup with double opt-in
- **Interactive calculator** — Livewire-powered, implementing MI's exact pricing methodology (length × width × tier × line × bird capacity formulas)
- **SEO-ready** — per-page meta titles/descriptions (translatable), Open Graph tags, automatic XML sitemap
- **SOLID architecture** — Services + Actions + Interfaces; see `ARCHITECTURE.md`
- **Honeypot spam protection** for contact / newsletter forms
- **Performance** — Lenis smooth scroll, GSAP-powered reveals, lazy-loaded images

---

## 🛠 Tech Stack

| Layer | Library |
|---|---|
| Framework | Laravel 12 (PHP 8.3+) |
| Admin | Filament 4 |
| UI | Livewire 3 + Alpine + Tailwind 4 |
| i18n | `spatie/laravel-translatable` |
| Media | `spatie/laravel-medialibrary` |
| Tags | `spatie/laravel-tags` |
| Permissions | `spatie/laravel-permission` |
| Sitemap | `spatie/laravel-sitemap` |
| Anti-spam | `spatie/laravel-honeypot` |
| Animations | GSAP + Lenis + Lucide icons |

---

## 🚀 Quick Start

### Prerequisites

- PHP **8.3+** (`pdo_mysql`, `gd` or `imagick`, `intl`, `mbstring`, `zip` extensions)
- Composer 2.x
- Node.js 20+
- MySQL 8 / MariaDB 10.6+ / PostgreSQL 14+ / SQLite 3.35+

### Installation

```bash
# 1) Clone & install dependencies
git clone <your-repo> mi-poultry-cms
cd mi-poultry-cms
composer install
npm install

# 2) Environment setup
cp .env.example .env
php artisan key:generate
# Edit .env to set your DB credentials and APP_URL

# 3) Database
php artisan migrate --seed

# 4) Storage symlink (so uploaded media is publicly accessible)
php artisan storage:link

# 5) Build frontend assets
npm run build      # production
# or
npm run dev        # development with HMR

# 6) Run
php artisan serve
```

Visit **http://localhost:8000** for the public site.

### Admin panel

- URL: **http://localhost:8000/admin**
- Default credentials (created by `UserSeeder`):
  - Email: `admin@mi-poultry.com`
  - Password: `Admin@2026`

⚠️ **Change the password immediately after first login.**

---

## 🌐 Localization

The site supports Arabic (default) and English.

- **URL prefix routing**: `/ar/products`, `/en/products`
- **Switching locale**: clicking the locale switcher hits `/locale/{ar|en}` then redirects back
- **Translatable content**: stored as JSON in DB columns (e.g. `name`, `title`, `description`) and accessed via `$model->getTranslation('name', 'ar')` or simply `$model->name` (returns current locale)
- **UI strings**: `resources/lang/{ar,en}/messages.php`

Adding a new language:
1. Add it to `APP_AVAILABLE_LOCALES` in `.env` (e.g. `ar,en,fr`)
2. Update the regex in `routes/web.php` (`->where(['locale' => 'ar|en|fr'])`)
3. Create `resources/lang/fr/messages.php` (copy from `en`, translate values)
4. Re-seed translatable models or add translations via admin

---

## 💰 The Pricing Calculator

The Livewire calculator at `/ar/#calculator` implements MI's pricing methodology:

| Item | Formula |
|---|---|
| Bird count | `(L − 4) × 2 × tiers × lines × 16` |
| Concrete | `L × W × concrete_per_m²` |
| Steel | `L × W × steel_per_m²` |
| Walls | `L × H × 2 × walls_per_m²` |
| Tanks | fixed |
| Battery | `birds × bird_unit_cost` |
| Rear fans | `ceil(birds × 2.1 / 5000)` |
| Cooling | `rear_fans × cooling_factor` |
| Windows | `L − 4` units |
| Side fans | 6 / 8 / 10 (by L) |
| Heaters | 2 / 4 / 6 (by L) |
| Control | fixed |

**Editing unit prices** without touching code:

The defaults live in `config/mi.php`. Override in `.env`:

```env
CALC_CONCRETE_M2=2800
CALC_STEEL_M2=4200
CALC_WALLS_M2=2400
CALC_TANKS=95000
CALC_BIRD=220
CALC_REAR_FAN=42000
CALC_COOLING_FACTOR=5500
CALC_WINDOW=4800
CALC_SIDE_FAN=35000
CALC_HEATER=26000
CALC_CONTROL=110000
```

Or change them dynamically from the Filament admin (Settings → Calculator).

---

## 📦 Content Management

The Filament admin organizes content into groups:

- **الصفحة الرئيسية** — Hero slides, Features, Team, Testimonials, FAQs, Chairman quote
- **الكتالوج** — Products, Projects gallery, Production stages
- **المدوّنة** — Blog posts, Categories, Comments (with moderation), Newsletter subscribers
- **الاستفسارات** — Contact form submissions, Calculator quote requests
- **المحتوى** — Static pages (About, Privacy, Terms)

Every record can be:
- Translated (each translatable field has Arabic & English tabs)
- Uploaded with images (via spatie media library)
- Annotated with SEO meta (title/description per locale)
- Reordered by drag-and-drop
- Activated / deactivated

---

## 📝 Blog Module

- **Posts**: rich-editor content, featured image, category, tags, author, scheduled publishing, SEO meta
- **Comments**: front-end submission, admin moderation (`pending` → `approved` / `spam`)
- **Newsletter**: double opt-in confirmation by email; admin can export subscribers

Routes:
- `/ar/blog` — index
- `/ar/blog/category/{slug}` — by category
- `/ar/blog/{post-slug}` — single post + comments + newsletter
- `POST /ar/blog/{post-slug}/comment` — submit comment (moderated)
- `POST /ar/newsletter/subscribe` — subscribe (honeypot-protected)

---

## 🔍 SEO

- Per-model `seo_meta` JSON: `{ ar: {title, description}, en: {title, description} }`
- `<head>` partial automatically emits `<title>`, meta description, canonical, hreflang, Open Graph
- `/sitemap.xml` regenerates nightly via `Schedule::command('sitemap:generate')->daily()`
- Robots.txt at `/robots.txt`

---

## 🧪 Testing

```bash
php artisan test
```

Includes:
- `CalculatorServiceTest` — verifies pricing formulas against MI's reference 81×12×3.5 house
- `HomePageTest` — locale routing & basic page rendering

---

## 📂 Project Structure

```
app/
├── Actions/                 # Single-purpose write operations
├── Filament/Resources/      # 16 admin resources
├── Http/
│   ├── Controllers/         # Thin HTTP layer
│   ├── Middleware/          # SetLocale
│   └── Requests/            # Form validation
├── Livewire/                # Server-side interactive components
├── Models/                  # Eloquent models with HasTranslations
├── Services/
│   ├── Contracts/           # Interfaces (SOLID-DIP)
│   ├── CalculatorService    # Pricing engine
│   ├── NewsletterService
│   └── SeoService
└── Traits/HasSeoMeta.php

database/
├── migrations/              # 22 tables
├── seeders/                 # Pre-populated with v10 content
└── factories/

resources/
├── css/app.css              # ~1,500 lines: design tokens, components
├── js/app.js                # Lenis + GSAP + interactions
├── lang/{ar,en}/messages.php
└── views/
    ├── layouts/public.blade.php
    ├── partials/            # header, footer, loader, seo-meta
    ├── sections/            # hero, products, features... (DB-driven)
    ├── components/
    ├── livewire/
    ├── blog/
    └── products/

routes/web.php               # Bilingual route group
```

See **`ARCHITECTURE.md`** for SOLID principles applied and design decisions.

---

## 🚢 Deployment

See **`DEPLOYMENT.md`** for production guidance (PHP-FPM + Nginx, queue worker, scheduler, opcache, S3, CDN).

---

## 📄 License

Proprietary — © MI Automatic Poultry Cages, Damietta, Egypt.

