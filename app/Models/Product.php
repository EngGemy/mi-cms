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

    public array $translatable = [
        'name', 'summary', 'description', 'badge',
        'specs', 'seo_title', 'seo_description',
    ];

    protected $fillable = [
        'slug', 'name', 'summary', 'description', 'badge', 'specs',
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
            ->logOnly(['name', 'position', 'is_active', 'is_featured', 'specs', 'badge'])
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
        $this->addMediaConversion('large')->width(1400)->quality(85);
        $this->addMediaConversion('card')->width(800)->quality(82);
        $this->addMediaConversion('thumb')->width(300)->quality(80);
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
}
