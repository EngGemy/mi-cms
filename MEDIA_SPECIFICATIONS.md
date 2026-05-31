# MEDIA_SPECIFICATIONS.md
> Canonical reference for content editors uploading images and videos to the MI Poultry CMS.
> All dimensions derived from the actual CSS and Blade templates in this repository.

---

## 1. MASTER MEDIA SPEC TABLE

| # | Location / Component | Model.Field | View File | HTML Element | Rendered Size (largest) | Aspect Ratio | Fit | Upload Recommended (W×H) | Format | Max File Size |
|---|---|---|---|---|---|---|---|---|---|---|
| 1 | **Hero slide image** | `HeroSlide.image` | `sections/hero.blade.php` | `background-image` div | ~660×825px (desktop, 4:5) | **4:5** desktop / 4:3 tablet | cover (bg-size:cover) | **1400×1750px** | WebP / JPG | ≤ 300 KB |
| 2 | **Feature card image** | `Feature.image` | `sections/features.blade.php` | `<img>` | ~440×275px (3-col lg grid) | **16:10** | object-cover | **1600×1000px** | WebP / JPG | ≤ 150 KB |
| 3 | **Product card** (list + blog) | `Product.main` / `BlogPost.featured` | `sections/products.blade.php`, `blog/index.blade.php` | `<img>` | ~450×338px (3-col grid) | **4:3** | object-cover | **900×675px** | WebP / JPG | ≤ 100 KB |
| 4 | **Product detail — main gallery** | `Product.main` | `products/show.blade.php` | `<img>` | ~600×450px (4:3 panel) | **4:3** | object-cover | **1400×1050px** | WebP / JPG | ≤ 250 KB |
| 5 | **Product detail — thumbnails** | `Product.gallery` | `products/show.blade.php` | `<img>` | 72×72px (fixed) | **1:1** | object-cover | **300×300px** | WebP / JPG | ≤ 40 KB each |
| 6 | **Blog post hero** (detail page) | `BlogPost.featured` | `blog/show.blade.php` | `<img>` | Full content width, natural height (~1200px wide) | **natural** (no crop) | none (auto height) | **1600×900px** (16:9 recommended) | WebP / JPG | ≤ 250 KB |
| 7 | **Production stage image** | `ProductionStage.image` | `sections/production-stages.blade.php` | `<img>` | 380×285px (stage card 380px wide, 4:3) | **4:3** | object-cover | **900×675px** | WebP / JPG | ≤ 100 KB |
| 8 | **Project featured card** (projects list) | `Project.cover` | `sections/projects.blade.php` | `<img>` | ~700×437px (desktop, 16:10 panel) | **16:10** | object-cover | **1600×1000px** | WebP / JPG | ≤ 200 KB |
| 9 | **Project tile** (homepage masonry) | `Project.cover` | `sections/projects.blade.php` | `<img>` | `.pt-1` ≈ 840×360px; `.pt-2/3` ≈ 600×180px | **varies** | object-cover | **900×600px** (covers all spans) | WebP / JPG | ≤ 150 KB |
| 10 | **Project detail hero** | `Project.cover` | `projects/show.blade.php` | `<img>` | Full viewport width × 88vh (≈1440×950px) | **16:9** (fills viewport) | object-cover | **2560×1440px** | WebP / JPG | ≤ 400 KB |
| 11 | **Project gallery** (detail, lightbox) | `Project.gallery` | `projects/show.blade.php` | `<img>` | Lightbox: max 90vw×88vh; thumbs: small | **natural** | object-contain (lightbox) | **1600×1200px** | WebP / JPG | ≤ 300 KB each |
| 12 | **Project blueprints** | `Project.blueprint` | `projects/show.blade.php` | `<img>` | Same lightbox as gallery | **natural** | object-contain (lightbox) | **2000px wide** | PDF / WebP / PNG | ≤ 5 MB each |
| 13 | **Project phase image** | `ProjectPhase.image` | `projects/show.blade.php` | `<img>` | Inline in phase tab; ~800px wide | **16:9 or 4:3** | object-cover | **800×600px** | WebP / JPG | ≤ 120 KB |
| 14 | **Related project card** | `Project.cover` | `projects/show.blade.php` | `<img>` | `.pi-card-img` aspect-ratio 16:10 | **16:10** | object-cover | **900×562px** | WebP / JPG | ≤ 120 KB |
| 15 | **Certification logo** (about page, small) | `Certification.logo` | `about.blade.php` | `<img>` | 56×56px (fixed CSS size) | **1:1** | object-contain | **200×200px** | PNG (transparent) / WebP | ≤ 30 KB |
| 16 | **Certification hover preview** | `Certification.logo` | `about.blade.php` | `<img>` | 220px wide, auto height tooltip | **natural** | object-contain | same upload as above | PNG / WebP | — |
| 17 | **Header logo** | `GeneralSettings.logo_path` | `partials/header.blade.php` | `<img>` | 40×40px (fixed CSS) | **1:1** | object-cover | **200×200px** | PNG (transparent) | ≤ 20 KB |
| 18 | **Footer logo** | `GeneralSettings.logo_path` | `partials/footer.blade.php` | `<img>` | 40×40px (same class) | **1:1** | object-cover | same as header | PNG (transparent) | ≤ 20 KB |
| 19 | **OG / Share image** | `SeoSettings.og_image_path` | `partials/seo-meta.blade.php` | `<meta og:image>` | Social preview: 1200×630px | **1.91:1** | n/a | **1200×630px** | JPG / WebP | ≤ 200 KB |
| 20 | **Browser favicon** | `GeneralSettings.favicon_path` | `partials/seo-meta.blade.php` | `<link rel=icon>` | Browser tab icon | **1:1** | n/a | **64×64px** | PNG / ICO | ≤ 10 KB |
| 21 | **Team member avatar** | `TeamMember.avatar` | `sections/team.blade.php` | ⚠️ TEXT only (initials shown) | — | — | — | **600×600px** (for future use) | WebP / JPG | ≤ 60 KB |
| 22 | **Testimonial avatar** | `Testimonial.avatar` | `sections/testimonials.blade.php` | ⚠️ TEXT only (initials shown) | — | — | — | **200×200px** (for future use) | WebP / JPG | ≤ 30 KB |
| 23 | **Chairman portrait** | `ChairmanQuote.portrait` | `sections/chairman.blade.php` | ⚠️ TEXT only ("mi" shown) | — | — | — | **400×400px** (for future use) | WebP / JPG | ≤ 60 KB |

---

## 2. PER-TYPE QUICK REFERENCE (Editor Cheat Sheet)

### عربي (للمحررين)

| النوع | المقاس المطلوب | نسبة الأبعاد | الصيغة | الحجم الأقصى |
|---|---|---|---|---|
| **صورة شريحة Hero** | 1400×1750 بكسل | 4:5 (عمودية) | WebP أو JPG | 300 KB |
| **صورة ميزة (Feature)** | 1600×1000 بكسل | 16:10 | WebP أو JPG | 150 KB |
| **صورة منتج (بطاقة وتفاصيل)** | 1400×1050 بكسل | 4:3 | WebP أو JPG | 250 KB |
| **صورة مدوّنة (غلاف)** | 1600×900 بكسل | 16:9 | WebP أو JPG | 250 KB |
| **صورة مرحلة إنتاج** | 900×675 بكسل | 4:3 | WebP أو JPG | 100 KB |
| **صورة مشروع (البطل/الغلاف)** | 2560×1440 بكسل | 16:9 | WebP أو JPG | 400 KB |
| **صور معرض المشروع** | 1600×1200 بكسل | طبيعية | WebP أو JPG | 300 KB لكل صورة |
| **مخطط/Blueprint** | 2000 بكسل عرضاً | طبيعية | PDF أو PNG | 5 MB لكل ملف |
| **شعار الموقع (Logo)** | 200×200 بكسل | 1:1 | PNG (خلفية شفافة) | 20 KB |
| **شعار شهادة/اعتماد** | 200×200 بكسل | 1:1 | PNG (خلفية شفافة) | 30 KB |
| **صورة Open Graph (السوشيال)** | 1200×630 بكسل | 1.91:1 | JPG أو WebP | 200 KB |
| **Favicon** | 64×64 بكسل | 1:1 | PNG أو ICO | 10 KB |

---

### English (for editors)

| Type | Upload Size | Aspect Ratio | Format | Max Size |
|---|---|---|---|---|
| **Hero slide image** | 1400×1750 px | 4:5 (portrait) | WebP or JPG | 300 KB |
| **Feature card image** | 1600×1000 px | 16:10 | WebP or JPG | 150 KB |
| **Product image (card + detail)** | 1400×1050 px | 4:3 | WebP or JPG | 250 KB |
| **Blog post cover** | 1600×900 px | 16:9 | WebP or JPG | 250 KB |
| **Production stage image** | 900×675 px | 4:3 | WebP or JPG | 100 KB |
| **Project cover (hero + tiles)** | 2560×1440 px | 16:9 | WebP or JPG | 400 KB |
| **Project gallery photos** | 1600×1200 px | natural | WebP or JPG | 300 KB each |
| **Project blueprint** | 2000 px wide | natural | PDF or PNG | 5 MB each |
| **Site logo** | 200×200 px | 1:1 | PNG (transparent) | 20 KB |
| **Certification logo** | 200×200 px | 1:1 | PNG (transparent) | 30 KB |
| **OG / Social share image** | 1200×630 px | 1.91:1 | JPG or WebP | 200 KB |
| **Favicon** | 64×64 px | 1:1 | PNG or ICO | 10 KB |

---

## 3. GAPS & RISKS

### 3.1 — object-cover crops: editors MUST match these ratios

| Location | Aspect | Risk if wrong ratio uploaded |
|---|---|---|
| Hero slide | 4:5 (desktop) | Tops/bottoms cropped on desktop; sides cropped on tablet |
| Feature card | 16:10 | Top/bottom cropped for portrait images |
| Product card | 4:3 | Portrait products lose ≈ 25% from top/bottom |
| Production stage | 4:3 | Same as product |
| Project featured | 16:10 | Heavy crop for portrait shots |
| Project tiles (masonry) | varies by tile position | `.pt-1` (featured) is 840×360 → very wide, horizontal crops only |

### 3.2 — Filament fields with NO upload constraints (all currently missing)

Every `SpatieMediaLibraryFileUpload` field in this project has **no** `maxSize`, `acceptedFileTypes`, or `imageResizeTargetWidth` configured. Editors can upload 20 MB TIFFs or wrong-ratio images and they will be silently accepted.

| Resource | Field | Missing constraints |
|---|---|---|
| HeroSlideResource | `image` | maxSize, acceptedTypes, imageEditorAspectRatios |
| FeatureResource | `image` | maxSize, acceptedTypes, imageEditorAspectRatios |
| ProductResource | `main` | maxSize, acceptedTypes, imageEditorAspectRatios |
| ProductResource | `gallery` | maxSize, acceptedTypes |
| BlogPostResource | `featured` | maxSize, acceptedTypes, imageEditorAspectRatios |
| BlogPostResource | `gallery` | maxSize, acceptedTypes |
| ProductionStageResource | `image` | maxSize, acceptedTypes, imageEditorAspectRatios |
| ProjectResource | `cover` | maxSize, acceptedTypes, imageEditorAspectRatios |
| ProjectResource | `gallery` | maxSize, acceptedTypes |
| ProjectResource | `blueprints` | maxSize |
| CertificationResource | `logo` | maxSize, acceptedTypes (gets thumb:200px but source can be huge) |
| GeneralSettingsPage | `logo_path` / `favicon_path` | acceptedTypes |
| SeoSettingsPage | `og_image_path` | maxSize, acceptedTypes, imageEditorAspectRatios |

### 3.3 — Media uploaded but NOT rendered in public templates

These three fields accept uploads via Filament but the public Blade templates currently render **text initials only** (not `<img>` tags). The media is stored in the database but invisible to visitors:

| Model | Field | Current template | Note |
|---|---|---|---|
| `TeamMember` | `avatar` | `<div class="team-avatar">{{ $m->initials }}</div>` | Upload works but never shown |
| `Testimonial` | `avatar` (SpatieMedia not even configured — no `registerMediaCollections`) | text only | No collection registered |
| `ChairmanQuote` | `portrait` | `<div class="chairman-avatar">mi</div>` | Upload works but never shown |

### 3.4 — About section image is hardcoded Unsplash

`sections/about.blade.php` line 6 contains a hardcoded Unsplash URL (`premium_photo-1661930553507...`). There is no admin-editable field for the About section image. If this image needs to change, it requires a code edit.

### 3.5 — Videos: no poster, no size limit

| Location | Upload field | Issues |
|---|---|---|
| ProductionStage | `video` collection (MP4/WebM) | No `maxSize` — editors can upload 1 GB files |
| Project | `video` collection | No `maxSize` |
| ProjectPhase | `video` collection | No `maxSize` |

Recommended: add `->maxSize(512000)` (500 MB) as a soft guard, and document that all uploaded videos should be H.264 MP4, ≤ 1080p, ≤ 10 Mbps bitrate.

---

## 4. RECOMMENDED FILAMENT ENFORCEMENT SNIPPETS

> These are **suggested** code changes — not applied. Add them to enforce correct uploads at the field level.

### 4.1 Hero slide image
```php
// HeroSlideResource.php — inside form()
SpatieMediaLibraryFileUpload::make('image')
    ->label('الصورة')
    ->collection('image')
    ->image()
    ->imageEditor()
    ->imageEditorAspectRatios(['4:5'])          // lock desktop ratio
    ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
    ->maxSize(4096)                              // 4 MB — resized by conversion
    ->imageResizeTargetWidth(1400)
    ->imageResizeTargetHeight(1750),
```

### 4.2 Feature card image
```php
SpatieMediaLibraryFileUpload::make('image')
    ->collection('image')
    ->image()
    ->imageEditor()
    ->imageEditorAspectRatios(['16:10', '8:5'])
    ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
    ->maxSize(3072)
    ->imageResizeTargetWidth(1600),
```

### 4.3 Product main image
```php
SpatieMediaLibraryFileUpload::make('main')
    ->collection('main')
    ->image()
    ->imageEditor()
    ->imageEditorAspectRatios(['4:3'])
    ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
    ->maxSize(5120)
    ->imageResizeTargetWidth(1400),
```

### 4.4 Blog post featured image
```php
SpatieMediaLibraryFileUpload::make('featured')
    ->collection('featured')
    ->image()
    ->imageEditor()
    ->imageEditorAspectRatios(['16:9', '4:3'])
    ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
    ->maxSize(5120)
    ->imageResizeTargetWidth(1600),
```

### 4.5 Project cover image
```php
SpatieMediaLibraryFileUpload::make('cover')
    ->collection('cover')
    ->image()
    ->imageEditor()
    ->imageEditorAspectRatios(['16:9', '16:10'])
    ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
    ->maxSize(8192)
    ->imageResizeTargetWidth(2560),
```

### 4.6 Certification logo
```php
SpatieMediaLibraryFileUpload::make('logo')
    ->collection('logo')
    ->image()
    ->imageEditor()
    ->acceptedFileTypes(['image/png', 'image/webp', 'image/svg+xml'])
    ->maxSize(1024)                              // 1 MB — logo should be small
    ->imageResizeTargetWidth(400),
```

### 4.7 Site logo (GeneralSettingsPage)
```php
Forms\Components\FileUpload::make('logo_path')
    ->image()
    ->disk('public')
    ->directory('settings')
    ->acceptedFileTypes(['image/png', 'image/webp', 'image/svg+xml'])
    ->maxSize(512),                              // 512 KB max
```

### 4.8 OG image (SeoSettingsPage)
```php
Forms\Components\FileUpload::make('og_image_path')
    ->image()
    ->disk('public')
    ->directory('settings')
    ->imageEditor()
    ->imageEditorAspectRatios(['1.91:1'])
    ->acceptedFileTypes(['image/jpeg', 'image/webp'])
    ->maxSize(2048)
    ->imageResizeTargetWidth(1200)
    ->imageResizeTargetHeight(630),
```

### 4.9 Video uploads (ProductionStage, Project, ProjectPhase)
```php
SpatieMediaLibraryFileUpload::make('video')
    ->collection('video')
    ->acceptedFileTypes(['video/mp4', 'video/webm'])
    ->maxSize(512000),                           // 500 MB hard ceiling
```

---

## Model Media Conversion Reference

| Model | Collection | Conversions registered |
|---|---|---|
| HeroSlide | `image` | `large` → 1400px w, q85 · `thumb` → 400px w, q80 |
| Feature | `image` | `card` → 800px w, q82 |
| Product | `main` | `large` → 1400px w, q85 · `card` → 800px w, q82 · `thumb` → 300px w, q80 |
| Product | `gallery` | same conversions |
| BlogPost | `featured` | `hero` → 1600px w, q85 · `card` → 900px w, q82 · `thumb` → 400px w, q80 |
| BlogPost | `gallery` | same conversions |
| ProductionStage | `image` | `card` → 900px w, q82 |
| ProductionStage | `video` | _(no conversions)_ |
| Project | `cover` | `hero` → 1600px w, q85 · `card` → 900px w, q82 · `thumb` → 400px w, q80 |
| Project | `gallery` | same conversions |
| Project | `blueprint` | same conversions |
| Project | `video` | _(no conversions)_ |
| ProjectPhase | `image` | `card` → 800px w, q82 · `thumb` → 300px w, q80 |
| ProjectPhase | `video` | _(no conversions)_ |
| ProjectStage | `photos` | `card` → 900px w, q82 · `thumb` → 400px w, q80 |
| Certification | `logo` | `thumb` → 200px w, q85 |
| ChairmanQuote | `portrait` | _(no conversions registered)_ |
| TeamMember | `avatar` | _(no conversions registered)_ |

---

*Last updated: 2026-05-31 — derived from CSS, Blade templates, and model code. Update this file whenever a new upload field or display component is added.*
