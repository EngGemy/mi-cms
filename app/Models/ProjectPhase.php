<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class ProjectPhase extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    public array $translatable = ['title', 'description'];

    protected $fillable = [
        'project_id', 'title', 'description',
        'icon', 'status', 'position', 'video_url',
    ];

    protected $casts = [
        'position' => 'integer',
    ];

    public const STATUSES = [
        'completed'   => ['ar' => 'مكتمل',   'en' => 'Completed'],
        'in_progress' => ['ar' => 'جارٍ التنفيذ', 'en' => 'In Progress'],
        'planned'     => ['ar' => 'مخطط',    'en' => 'Planned'],
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
        $this->addMediaCollection('video')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('card')->width(800)->quality(82)->nonQueued();
        $this->addMediaConversion('thumb')->width(300)->quality(80)->nonQueued();
    }

    public function getImageUrl(string $conv = 'card'): ?string
    {
        $m = $this->getFirstMedia('image');
        return $m ? $m->getUrl($conv) : null;
    }

    public function getVideoUrl(): ?string
    {
        // Prioritize uploaded video file, fallback to video_url
        $m = $this->getFirstMedia('video');
        if ($m) {
            return $m->getUrl();
        }
        return $this->video_url ?: null;
    }

    public function hasVideo(): bool
    {
        return $this->getFirstMedia('video') !== null || !empty($this->video_url);
    }

    public function getVideoEmbed(): ?string
    {
        $url = $this->getVideoUrl();
        if (!$url) return null;

        $ytMatch = [];
        $viMatch = [];
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $ytMatch);
        preg_match('/vimeo\.com\/(\d+)/', $url, $viMatch);

        if ($ytMatch[1] ?? null) {
            return 'https://www.youtube.com/embed/' . $ytMatch[1] . '?autoplay=1&rel=0';
        }
        if ($viMatch[1] ?? null) {
            return 'https://player.vimeo.com/video/' . $viMatch[1] . '?autoplay=1';
        }
        return null;
    }

    public function getVideoType(): string
    {
        $url = $this->getVideoUrl();
        if (!$url) return 'none';
        if ($this->getVideoEmbed()) return 'embed';
        return 'file';
    }

    public function getStatusLabel(): string
    {
        $locale = app()->getLocale();
        return self::STATUSES[$this->status][$locale] ?? $this->status;
    }

    public function getStatusColor(): string
    {
        return match ($this->status) {
            'completed'   => '#1A1611', // black / ink
            'in_progress' => '#C8102E', // mi-red
            'planned'     => '#7A6E63', // gray
            default       => '#7A6E63',
        };
    }
}
