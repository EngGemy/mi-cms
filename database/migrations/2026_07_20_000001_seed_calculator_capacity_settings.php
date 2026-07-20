<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $defaults = [
            'service_length' => (float) env('POULTRY_SERVICE_LENGTH', 10),
            'fan_capacity_kg' => (float) env('POULTRY_FAN_CAPACITY_KG', 5000),
            'cooling_pad_meters_per_fan' => (float) env('POULTRY_COOLING_PAD_M_FAN', 5.5),
            'layer_nest_module_m' => (float) env('POULTRY_LAYER_NEST_MODULE_M', 0.60),
            'width_lines_map' => [
                '12' => 4,
                '15' => 5,
                '16.5' => 6,
                '17.5' => 6,
            ],
            'broiler_weight_birds_map' => [
                '1.4' => 22,
                '1.5' => 21,
                '1.6' => 20,
                '1.7' => 19,
                '1.8' => 18,
                '1.9' => 17,
                '2.0' => 16,
                '2.1' => 16,
                '2.2' => 15,
                '2.3' => 15,
                '2.4' => 14,
                '2.5' => 14,
                '2.6' => 13,
                '2.7' => 12,
                '2.8' => 12,
                '2.9' => 11,
                '3.0' => 11,
            ],
            'default_length' => 71,
            'default_width' => 12,
            'default_height' => 3.5,
            'default_floors' => 3,
            'default_lines' => 4,
            'min_length' => 71,
            'max_length' => 300,
            'min_width' => 8,
            'max_width' => 30,
            'min_height' => 3,
            'max_height' => 6,
            'floors_options' => [1, 2, 3, 4, 5],
            'lines_options' => [3, 4, 5, 6],
        ];

        $rows = [];
        foreach ($defaults as $name => $value) {
            $rows[] = [
                'group' => 'calculator',
                'name' => $name,
                'locked' => false,
                'payload' => json_encode($value),
            ];
        }

        DB::table('settings')->upsert($rows, ['group', 'name']);
    }

    public function down(): void
    {
        DB::table('settings')->where('group', 'calculator')->whereIn('name', [
            'service_length',
            'fan_capacity_kg',
            'cooling_pad_meters_per_fan',
            'layer_nest_module_m',
            'width_lines_map',
            'broiler_weight_birds_map',
            'default_length',
            'default_width',
            'default_height',
            'default_floors',
            'default_lines',
            'min_length',
            'max_length',
            'min_width',
            'max_width',
            'min_height',
            'max_height',
            'floors_options',
            'lines_options',
        ])->delete();
    }
};
