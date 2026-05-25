<?php

namespace App\Services;

use App\Services\Contracts\CalculatorServiceInterface;

/**
 * Pricing engine — implements MI's internal estimation methodology.
 * Pure / deterministic. Single Responsibility: produce a breakdown.
 */
class CalculatorService implements CalculatorServiceInterface
{
    public function __construct(
        private readonly array $prices,
    ) {
        // $prices comes from config('mi.calculator') via service binding
    }

    public function compute(array $input): array
    {
        $L      = (float) $input['length'];
        $W      = (float) $input['width'];
        $H      = (float) $input['height'];
        $floors = (int) $input['floors'];
        $lines  = (int) $input['lines'];

        $p = $this->prices;

        // ---- Bird capacity ----
        $effLength = max(0, $L - 4);
        $birds = (int) round($effLength * 2 * $floors * $lines * 16);

        // ---- Construction ----
        $concrete = $L * $W * $p['concrete_m2'];
        $steel    = $L * $W * $p['steel_m2'];
        $walls    = $L * $H * 2 * $p['walls_m2'];
        $tanks    = $p['tanks_fixed'];
        $consTotal = $concrete + $steel + $walls + $tanks;

        // ---- Battery system ----
        $battery = $birds * $p['bird_cost'];

        // ---- Accessories ----
        $rearFans = (int) ceil($birds * $p['bird_weight_kg'] / 5000);
        $rearFansCost = $rearFans * $p['rear_fan'];
        $cooling = $rearFans * $p['cooling_factor'];

        $windowsCount = (int) max(0, $L - 4);
        $windowsCost = $windowsCount * $p['window'];

        $sideFans = $L < 60 ? 6 : ($L < 90 ? 8 : 10);
        $sideFansCost = $sideFans * $p['side_fan'];

        $heaters = $L < 60 ? 2 : ($L < 90 ? 4 : 6);
        $heatersCost = $heaters * $p['heater'];

        $control = $p['control_fixed'];

        $accTotal = $rearFansCost + $cooling + $windowsCost
            + $sideFansCost + $heatersCost + $control;

        $grand = $consTotal + $battery + $accTotal;

        return [
            'inputs'   => compact('L', 'W', 'H', 'floors', 'lines'),
            'birds'    => $birds,
            'effective_length' => $effLength,
            'construction' => [
                'concrete' => $concrete,
                'steel'    => $steel,
                'walls'    => $walls,
                'tanks'    => $tanks,
                'total'    => $consTotal,
            ],
            'battery' => [
                'count'     => $birds,
                'unit_cost' => $p['bird_cost'],
                'total'     => $battery,
            ],
            'accessories' => [
                'rear_fans'      => ['count' => $rearFans,    'total' => $rearFansCost],
                'cooling'        => ['total' => $cooling],
                'windows'        => ['count' => $windowsCount,'total' => $windowsCost],
                'side_fans'      => ['count' => $sideFans,    'total' => $sideFansCost],
                'heaters'        => ['count' => $heaters,     'total' => $heatersCost],
                'control'        => ['total' => $control],
                'total'          => $accTotal,
            ],
            'grand_total' => $grand,
            'currency'    => 'EGP',
        ];
    }
}
