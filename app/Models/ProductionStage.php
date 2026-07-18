<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class ProductionStage extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    public array $translatable = ['eyebrow', 'title', 'description'];

    protected $fillable = [
        'stage_number', 'eyebrow', 'title', 'description',
        'video_url', 'position', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean', 'position' => 'integer'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
        // Each stage can have its own short video (mp4) uploaded
        $this->addMediaCollection('video')->singleFile()
            ->acceptsMimeTypes(['video/mp4', 'video/webm', 'video/quicktime']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('card')->width(900)->quality(82)
            ->performOnCollections('image')
            ->nonQueued();
    }

    public function getImageUrl(): ?string
    {
        $m = $this->getFirstMedia('image');
        return $m ? $m->getUrl('card') : null;
    }

    public function getVideoUrl(): ?string
    {
        if ($this->video_url) return $this->video_url;
        $m = $this->getFirstMedia('video');
        return $m?->getUrl();
    }

    public function scopeActive($q) { return $q->where('is_active', true)->orderBy('position'); }
}
