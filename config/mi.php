<?php

return [
    'phone_primary' => env('MI_PHONE_PRIMARY', '+201030003186'),
    'phone_support' => env('MI_PHONE_SUPPORT', '+201030003186'),
    'whatsapp'      => env('MI_WHATSAPP', '201030003186'),
    'email'         => env('MI_EMAIL', 'info@mi-poultry.com'),
    'inbox'         => env('MI_CONTACT_INBOX', 'sales@mi-poultry.com'),

    'address' => [
        'ar' => env('MI_ADDRESS_AR', 'دمياط · مصر'),
        'en' => env('MI_ADDRESS_EN', 'Damietta · Egypt'),
    ],

    'available_locales' => explode(',', env('APP_AVAILABLE_LOCALES', 'ar,en')),

    /*
    |--------------------------------------------------------------------------
    | Pricing Calculator — Unit Prices (EGP)
    |--------------------------------------------------------------------------
    | These power the live calculator on the public site and the Filament
    | "Calculator Settings" page. Update once and they propagate.
    */
    'calculator' => [
        'concrete_m2'      => (float) env('CALC_CONCRETE_M2', 2800),
        'steel_m2'         => (float) env('CALC_STEEL_M2', 4200),
        'walls_m2'         => (float) env('CALC_WALLS_M2', 2400),
        'tanks_fixed'      => (float) env('CALC_TANKS_FIXED', 95000),
        'bird_cost'        => (float) env('CALC_BIRD_COST', 220),
        'rear_fan'         => (float) env('CALC_REAR_FAN', 42000),
        'cooling_factor'   => (float) env('CALC_COOLING_FACTOR', 5500),
        'window'           => (float) env('CALC_WINDOW', 4800),
        'side_fan'         => (float) env('CALC_SIDE_FAN', 35000),
        'heater'           => (float) env('CALC_HEATER', 26000),
        'control_fixed'    => (float) env('CALC_CONTROL_FIXED', 110000),
        'bird_weight_kg'   => 2.1,
    ],
];
