<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CalculatorSettings extends Settings
{
    // Legacy financial (kept for internal/legacy compute)
    public float $concrete_m2;
    public float $steel_m2;
    public float $walls_m2;
    public float $tanks_fixed;
    public float $bird_cost;
    public float $rear_fan;
    public float $cooling_factor;
    public float $window;
    public float $side_fan;
    public float $heater;
    public float $control_fixed;

    // Capacity / biology
    public float $bird_weight_kg;
    public float $service_length;
    public float $fan_capacity_kg;
    public float $cooling_pad_meters_per_fan;
    public float $layer_nest_module_m;

    /** @var array<string, int> width (m) => recommended lines */
    public array $width_lines_map;

    /** @var array<string, int> bird weight kg => birds per nest */
    public array $broiler_weight_birds_map;

    // Public calculator defaults & bounds
    public float $default_length;
    public float $default_width;
    public float $default_height;
    public int $default_floors;
    public int $default_lines;

    public float $min_length;
    public float $max_length;
    public float $min_width;
    public float $max_width;
    public float $min_height;
    public float $max_height;

    /** Comma-separated or array of allowed floor counts */
    public array $floors_options;

    /** Comma-separated or array of allowed line counts */
    public array $lines_options;

    public static function group(): string
    {
        return 'calculator';
    }

    /**
     * Normalized tech payload for CalculatorService / Alpine.
     */
    public function techConfig(): array
    {
        return [
            'bird_weight_kg' => (float) $this->bird_weight_kg,
            'service_length' => (float) $this->service_length,
            'fan_capacity_kg' => (float) $this->fan_capacity_kg,
            'cooling_pad_meters_per_fan' => (float) $this->cooling_pad_meters_per_fan,
            'layer_nest_module_m' => (float) $this->layer_nest_module_m,
            'width_lines_map' => $this->normalizeMap($this->width_lines_map ?? []),
            'broiler_weight_birds_map' => $this->normalizeMap($this->broiler_weight_birds_map ?? []),
            'default_length' => (float) $this->default_length,
            'default_width' => (float) $this->default_width,
            'default_height' => (float) $this->default_height,
            'default_floors' => (int) $this->default_floors,
            'default_lines' => (int) $this->default_lines,
            'min_length' => (float) $this->min_length,
            'max_length' => (float) $this->max_length,
            'min_width' => (float) $this->min_width,
            'max_width' => (float) $this->max_width,
            'min_height' => (float) $this->min_height,
            'max_height' => (float) $this->max_height,
            'floors_options' => $this->normalizeIntList($this->floors_options ?? [1, 2, 3, 4, 5]),
            'lines_options' => $this->normalizeIntList($this->lines_options ?? [3, 4, 5, 6]),
        ];
    }

    private function normalizeMap(array $map): array
    {
        $out = [];
        foreach ($map as $k => $v) {
            $key = is_string($k) ? trim($k) : (string) $k;
            if ($key === '') {
                continue;
            }
            $out[$key] = (int) $v;
            // also store float-normalized forms for lookup
            if (is_numeric($key)) {
                $out[(string) (float) $key] = (int) $v;
            }
        }

        return $out;
    }

    private function normalizeIntList(array $list): array
    {
        return array_values(array_unique(array_map('intval', $list)));
    }
}
