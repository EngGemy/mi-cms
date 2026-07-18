<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AboutSettings extends Settings
{
    public ?string $hero_image_path = null;
    public ?string $video_url = null;
    public ?string $video_poster_path = null;
    public ?string $teaser_image_path = null;

    public array $seo = [];
    public array $hero = [];
    public array $stats = [];
    public array $story = [];
    public array $milestones = [];
    public array $vmg = [];
    public array $values_header = [];
    public array $values = [];
    public array $certs = [];
    public array $video = [];
    public array $catalog = [];
    public array $final_cta = [];
    public array $teaser = [];

    public static function group(): string
    {
        return 'about';
    }

    public function text(array $bag, string $key, ?string $fallback = null): string
    {
        $locale = app()->getLocale();
        $localizedKey = "{$key}_{$locale}";

        $value = $bag[$localizedKey] ?? $bag["{$key}_ar"] ?? $bag["{$key}_en"] ?? $bag[$key] ?? null;

        if (is_string($value) && $value !== '') {
            return $value;
        }

        return $fallback ?? '';
    }

    public function heroImageUrl(?string $fallback = null): ?string
    {
        return $this->mediaUrl($this->hero_image_path, $fallback);
    }

    public function videoPosterUrl(?string $fallback = null): ?string
    {
        return $this->mediaUrl($this->video_poster_path, $fallback);
    }

    public function teaserImageUrl(?string $fallback = null): ?string
    {
        return $this->mediaUrl($this->teaser_image_path, $fallback);
    }

    private function mediaUrl(?string $path, ?string $fallback = null): ?string
    {
        if ($path) {
            return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
        }

        return $fallback;
    }
}
