<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public ?string $catalog_pdf_url;
    public ?string $site_name;
    public ?string $logo_path;
    public ?string $favicon_path;
    public ?string $facebook_url;
    public ?string $instagram_url;
    public ?string $youtube_url;
    public ?string $twitter_url;
    public ?string $linkedin_url;

    public static function group(): string
    {
        return 'general';
    }
}
