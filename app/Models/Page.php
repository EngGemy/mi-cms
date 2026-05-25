<?php

namespace App\Models;

use App\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory, HasTranslations, HasSeoMeta;

    public array $translatable = ['title', 'content', 'seo_title', 'seo_description'];

    protected $fillable = [
        'slug', 'title', 'content',
        'seo_title', 'seo_description', 'is_published',
    ];

    protected $casts = ['is_published' => 'boolean'];

    public function scopePublished($q) { return $q->where('is_published', true); }
}
