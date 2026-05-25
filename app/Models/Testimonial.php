<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    public array $translatable = ['quote', 'author_name', 'author_role'];

    protected $fillable = [
        'quote', 'author_name', 'author_role',
        'initials', 'avatar_color', 'rating',
        'position', 'is_featured', 'is_active',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'rating'      => 'integer',
        'position'    => 'integer',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function scopeActive($q) { return $q->where('is_active', true)->orderBy('position'); }
}
