<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['question', 'answer'];

    protected $fillable = ['question', 'answer', 'category', 'position', 'is_active'];

    protected $casts = ['is_active' => 'boolean', 'position' => 'integer'];

    public function scopeActive($q) { return $q->where('is_active', true)->orderBy('position'); }
}
