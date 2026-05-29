<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SeoSettings extends Settings
{
    public ?string $meta_title_ar;
    public ?string $meta_title_en;
    public ?string $meta_description_ar;
    public ?string $meta_description_en;
    public ?string $og_image_path;
    public ?string $google_analytics_id;
    public ?string $google_tag_manager_id;

    public static function group(): string
    {
        return 'seo';
    }
}
