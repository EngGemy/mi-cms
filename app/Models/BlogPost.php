<?php

namespace App\Models;

use App\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class BlogPost extends Model implements HasMedia
{
    use HasFactory, HasTranslations, HasSlug, HasSeoMeta, HasTags, InteractsWithMedia, SoftDeletes;

    public array $translatable = [
        'title', 'excerpt', 'content', 'seo_title', 'seo_description',
    ];

    protected $fillable = [
        'author_id', 'blog_category_id',
        'slug', 'title', 'excerpt', 'content',
        'seo_title', 'seo_description',
        'reading_time_minutes', 'views_count',
        'published_at', 'is_featured', 'comments_enabled',
    ];

    protected $casts = [
        'published_at'         => 'datetime',
        'is_featured'          => 'boolean',
        'comments_enabled'     => 'boolean',
        'reading_time_minutes' => 'integer',
        'views_count'          => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(fn ($m) => $m->getTranslation('title', 'en', false)
                ?: $m->getTranslation('title', 'ar', false))
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('hero')->width(1600)->quality(85)->nonQueued();
        $this->addMediaConversion('card')->width(900)->quality(82)->nonQueued();
        $this->addMediaConversion('thumb')->width(400)->quality(80)->nonQueued();
    }

    public function getFeaturedImageUrl(string $conv = 'card'): ?string
    {
        $m = $this->getFirstMedia('featured');
        return $m ? $m->getUrl($conv) : null;
    }

    public function author()   { return $this->belongsTo(User::class, 'author_id'); }
    public function category() { return $this->belongsTo(BlogCategory::class, 'blog_category_id'); }
    public function comments() { return $this->hasMany(BlogComment::class)->whereNull('parent_id')->latest(); }
    public function approvedComments()
    {
        return $this->hasMany(BlogComment::class)->where('status', 'approved')->whereNull('parent_id')->latest();
    }
    public function allComments() { return $this->hasMany(BlogComment::class); }

    public function getRouteKeyName(): string { return 'slug'; }

    public function scopePublished($q)
    {
        return $q->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at');
    }

    public function getReadingTimeAttribute(): int
    {
        if ($this->reading_time_minutes) return $this->reading_time_minutes;
        $words = str_word_count(strip_tags($this->getTranslation('content', app()->getLocale(), false) ?: ''));
        return max(1, (int) ceil($words / 200));
    }
}
