<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class TeamMember extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    public array $translatable = ['name', 'role', 'description'];

    protected $fillable = [
        'name', 'role', 'description',
        'initials', 'badge_color',
        'phone', 'whatsapp', 'email',
        'is_featured', 'position', 'is_active',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'position'    => 'integer',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function getAvatarUrl(): ?string
    {
        return $this->getFirstMediaUrl('avatar') ?: null;
    }

    public function getWhatsappLink(): string
    {
        $wa = $this->whatsapp ?: config('mi.whatsapp');
        return "https://wa.me/{$wa}";
    }

    public function scopeActive($q) { return $q->where('is_active', true)->orderBy('position'); }
}
