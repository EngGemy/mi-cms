<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class HeroSlide extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    public array $translatable = ['label'];

    protected $fillable = [
        'label', 'image_url', 'position', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'position'  => 'integer',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);

        $this->addMediaCollection('video')->singleFile()
            ->acceptsMimeTypes(['video/mp4', 'video/webm']);

        $this->addMediaCollection('poster')->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        // Image + poster — all nonQueued (no queue worker on production)
        $this->addMediaConversion('hero')
            ->width(1920)
            ->quality(82)
            ->format('webp')
            ->performOnCollections('image', 'poster')
            ->nonQueued();

        $this->addMediaConversion('mobile')
            ->width(900)
            ->quality(80)
            ->format('webp')
            ->performOnCollections('image', 'poster')
            ->nonQueued();

        $this->addMediaConversion('thumb')
            ->width(400)
            ->quality(80)
            ->performOnCollections('image', 'poster')
            ->nonQueued();

        // Back-compat with older callers expecting `large`
        $this->addMediaConversion('large')
            ->width(1400)
            ->quality(85)
            ->performOnCollections('image')
            ->nonQueued();
    }

    public function getImageUrl(string $conversion = 'hero'): ?string
    {
        $media = $this->getFirstMedia('image');
        if ($media) {
            return $media->hasGeneratedConversion($conversion)
                ? $media->getUrl($conversion)
                : $media->getUrl();
        }

        return $this->image_url;
    }

    public function getVideoUrl(): ?string
    {
        return $this->getFirstMediaUrl('video') ?: null;
    }

    public function getPosterUrl(string $conversion = 'hero'): ?string
    {
        $media = $this->getFirstMedia('poster');
        if ($media) {
            return $media->hasGeneratedConversion($conversion)
                ? $media->getUrl($conversion)
                : $media->getUrl();
        }

        // Fall back to the slide image, then external URL
        return $this->getImageUrl($conversion);
    }

    public function hasVideo(): bool
    {
        return (bool) $this->getFirstMedia('video');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('position');
    }
}
