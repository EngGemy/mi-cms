<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Certification extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    public array $translatable = ['name', 'issuer', 'description'];

    protected $fillable = [
        'name', 'issuer', 'description',
        'year', 'position', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'position'  => 'integer',
        'year'      => 'integer',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(200)->quality(85)->performOnCollections('logo');
    }

    public function getLogoUrl(string $conv = 'thumb'): ?string
    {
        $m = $this->getFirstMedia('logo');
        return $m ? $m->getUrl($conv) : null;
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true)->orderBy('position');
    }
}
