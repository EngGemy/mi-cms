<?php

namespace App\Models;

use App\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasFactory, HasTranslations, HasSlug, HasSeoMeta, InteractsWithMedia, LogsActivity;

    public const CATEGORIES = [
        'cages' => ['ar' => 'بطاريات وأنظمة', 'en' => 'Cages & systems'],
        'ventilation' => ['ar' => 'شفاطات وتهوية', 'en' => 'Fans & ventilation'],
        'windows' => ['ar' => 'شبابيك هواء', 'en' => 'Air inlets / windows'],
        'drinkers' => ['ar' => 'سقايات ومياه', 'en' => 'Drinkers & water'],
        'concrete' => ['ar' => 'خرسانة وإنشاءات', 'en' => 'Concrete & civil'],
        'feeding' => ['ar' => 'تغذية وصوامع', 'en' => 'Feeding & silos'],
        'other' => ['ar' => 'أخرى', 'en' => 'Other'],
    ];

    public array $translatable = [
        'name', 'summary', 'description', 'badge',
        'specs', 'seo_title', 'seo_description',
    ];

    protected $fillable = [
        'slug', 'category', 'name', 'summary', 'description', 'badge', 'specs',
        'seo_title', 'seo_description',
        'position', 'is_active', 'is_featured',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'position'    => 'integer',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'category', 'position', 'is_active', 'is_featured', 'specs', 'badge'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('product');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model) {
                return $model->getTranslation('name', 'en', false)
                    ?: $model->getTranslation('name', 'ar', false);
            })
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('large')->width(1400)->quality(85)->nonQueued();
        $this->addMediaConversion('card')->width(800)->quality(82)->nonQueued();
        $this->addMediaConversion('thumb')->width(300)->quality(80)->nonQueued();
    }

    public function getMainImageUrl(string $conv = 'card'): ?string
    {
        $m = $this->getFirstMedia('main');
        return $m ? $m->getUrl($conv) : null;
    }

    public function getRouteKeyName(): string { return 'slug'; }

    public function activities()
    {
        return $this->morphMany(\Spatie\Activitylog\Models\Activity::class, 'subject');
    }

    public function scopeActive($q) { return $q->where('is_active', true)->orderBy('position'); }
    public function scopeFeatured($q) { return $q->where('is_featured', true); }

    public function scopeCategory($q, ?string $category)
    {
        if (!$category || $category === 'all') {
            return $q;
        }

        return $q->where('category', $category);
    }

    public function categoryLabel(?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        $meta = self::CATEGORIES[$this->category] ?? self::CATEGORIES['other'];

        return $meta[$locale] ?? $meta['en'] ?? $this->category;
    }

    /** @return array<string, string> */
    public static function categoryOptions(?string $locale = null): array
    {
        $locale = $locale ?: app()->getLocale();
        $out = [];
        foreach (self::CATEGORIES as $key => $labels) {
            $out[$key] = $labels[$locale] ?? $labels['en'];
        }

        return $out;
    }
}
