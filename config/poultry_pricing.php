<?php

return [
    /* ------------------------------------------------------------------
     | Poultry House — Technical Parameters (non-financial)
     | ------------------------------------------------------------------
     | These feed the public capacity calculator.  Adjust biology /
     | engineering constants here and they propagate everywhere.
     */

    // Length subtracted for service area (م منطقة الخدمات)
    'default_service_length' => (float) env('POULTRY_SERVICE_LENGTH', 10),

    // Ventilation
    'fan_capacity_kg' => (float) env('POULTRY_FAN_CAPACITY_KG', 5000),
    'cooling_pad_meters_per_fan' => (float) env('POULTRY_COOLING_PAD_M_FAN', 5.5),

    // Layer nests
    'layer_nest_module_m' => (float) env('POULTRY_LAYER_NEST_MODULE_M', 0.60),

    // Width → recommended lines map
    'width_lines_map' => [
        '12'   => 4,
        '12.0' => 4,
        '15'   => 5,
        '15.0' => 5,
        '16.5' => 6,
    ],

    // Broiler weight (kg) → birds per nest
    'broiler_weight_birds_map' => [
        '1.4'  => 22,
        '1.5'  => 21,
        '1.6'  => 20,
        '1.60' => 20,
        '1.7'  => 19,
        '1.8'  => 18,
        '1.85' => 18,
        '1.9'  => 17,
        '2.0'  => 16,
        '2.1'  => 16,
        '2.10' => 16,
        '2.2'  => 15,
        '2.3'  => 15,
        '2.4'  => 14,
        '2.5'  => 14,
        '2.6'  => 13,
        '2.65' => 13,
        '2.7'  => 12,
        '2.8'  => 12,
        '2.80' => 12,
        '2.9'  => 11,
        '3.0'  => 11,
    ],
];
