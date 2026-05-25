<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public ?string $catalog_pdf_url;

    public static function group(): string
    {
        return 'general';
    }
}
