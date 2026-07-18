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
        $this->addMediaCollection('image')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('large')->width(1400)->quality(85)->nonQueued();
        $this->addMediaConversion('thumb')->width(400)->quality(80)->nonQueued();
    }

    public function getImageUrl(string $conversion = 'large'): ?string
    {
        $media = $this->getFirstMedia('image');
        if ($media) {
            return $media->hasGeneratedConversion($conversion)
                ? $media->getUrl($conversion)
                : $media->getUrl();
        }
        return $this->image_url;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('position');
    }
}
