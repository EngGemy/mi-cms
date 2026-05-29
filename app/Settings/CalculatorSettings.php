<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CalculatorSettings extends Settings
{
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
    public float $bird_weight_kg;

    public static function group(): string
    {
        return 'calculator';
    }
}
