<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class ProjectStage extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    public array $translatable = ['title', 'description'];

    protected $fillable = [
        'project_id', 'title', 'description',
        'started_at', 'completed_at', 'position', 'is_done',
    ];

    protected $casts = [
        'started_at'   => 'date',
        'completed_at' => 'date',
        'is_done'      => 'boolean',
        'position'     => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photos');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('card')->width(900)->quality(82)->nonQueued();
        $this->addMediaConversion('thumb')->width(400)->quality(80)->nonQueued();
    }

    public function getPhotos(): array
    {
        return $this->getMedia('photos')
            ->map(fn ($m) => [
                'full'  => $m->getUrl('card'),
                'thumb' => $m->getUrl('thumb'),
            ])
            ->values()
            ->toArray();
    }

    public function getDateLabel(): ?string
    {
        if ($this->completed_at) return $this->completed_at->format('M Y');
        if ($this->started_at)   return $this->started_at->format('M Y');
        return null;
    }
}
