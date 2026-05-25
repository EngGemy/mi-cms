# نظام إدارة المحتوى - إم آي للدواجن

> نظام إدارة محتوى ثنائي اللغة (عربي/إنجليزي) لشركة **MI Automatic Poultry Cages**، مبني على Laravel 12 + Filament 4.

---

## ✨ المميزات

- **محتوى ثنائي اللغة** عبر `spatie/laravel-translatable`
- **لوحة تحكم Filament 4** على `/admin` بـ 16 resource
- **مكتبة وسائط احترافية** عبر `spatie/laravel-medialibrary`
- **مدوّنة كاملة** — مقالات + تصنيفات + تعليقات (بمراجعة) + اشتراك في النشرة البريدية
- **حاسبة تكلفة تفاعلية** — مبنية على معادلات MI الفعلية
- **SEO جاهز** — meta tags لكل صفحة، sitemap تلقائي
- **معمارية SOLID** — Services + Actions + Interfaces

## 🚀 التشغيل السريع

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
# عدّل .env لإعدادات قاعدة البيانات
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```

افتح **http://localhost:8000** للموقع
افتح **http://localhost:8000/admin** للوحة التحكم

**بيانات الدخول الافتراضية:**
- البريد: `admin@mi-poultry.com`
- كلمة المرور: `Admin@2026`

⚠️ **غيّر كلمة المرور فور أول تسجيل دخول.**

## 📂 الهيكل

- `app/Models/` — 17 model
- `app/Filament/Resources/` — 16 resource في 5 مجموعات
- `app/Services/` — منطق الأعمال (الحاسبة، SEO، النشرة)
- `resources/views/sections/` — أقسام الصفحة الرئيسية (DB-driven)
- `database/seeders/` — محتوى v10 جاهز

## 📞 الدعم

للأسئلة التقنية، راجع `ARCHITECTURE.md` و `DEPLOYMENT.md`.

