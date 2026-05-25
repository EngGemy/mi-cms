<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class BlogCategory extends Model
{
    use HasFactory, HasTranslations, HasSlug;

    public array $translatable = ['name', 'description'];

    protected $fillable = ['slug', 'name', 'description', 'color', 'position'];
    protected $casts = ['position' => 'integer'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(fn ($m) => $m->getTranslation('name', 'en', false)
                ?: $m->getTranslation('name', 'ar', false))
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string { return 'slug'; }

    public function posts() { return $this->hasMany(BlogPost::class); }
    public function publishedPosts() { return $this->hasMany(BlogPost::class)->published(); }
}
