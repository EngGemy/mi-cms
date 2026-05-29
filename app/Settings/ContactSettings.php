<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContactSettings extends Settings
{
    public ?string $phone_primary;
    public ?string $phone_support;
    public ?string $whatsapp;
    public ?string $email;
    public ?string $inbox;
    public ?string $address_ar;
    public ?string $address_en;

    public static function group(): string
    {
        return 'contact';
    }
}
