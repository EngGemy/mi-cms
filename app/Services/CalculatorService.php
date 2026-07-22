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

    /**
     * Compute capacity-only breakdown (no financial values).
     * Used by the public-facing price calculator widget.
     */
    public function computeCapacity(array $input): array
    {
        $L      = (float) $input['length'];
        $W      = (float) $input['width'];
        $H      = (float) $input['height'];
        $floors = (int) $input['floors'];
        $lines  = (int) $input['lines'];

        $p = $this->prices;
        $cfgFallback = config('poultry_pricing', []);

        $birdWeightKg = 2.1; // average bird weight 2100 g
        $barnType = (string) ($input['barn_type'] ?? 'layer');
        $allowedService = $barnType === 'broiler' ? [9, 10] : [8, 9];
        $serviceLength = (int) round((float) ($input['service_length'] ?? $allowedService[0]));
        if (! in_array($serviceLength, $allowedService, true)) {
            $serviceLength = $allowedService[0];
        }
        $rawEffective = max(0, $L - $serviceLength);
        // Always even — round UP (e.g. 71 → 72)
        $effectiveLength = (int) (ceil($rawEffective / 2) * 2);

        $widthMap = $p['width_lines_map'] ?? $cfgFallback['width_lines_map'] ?? [];
        $mappedLines = $widthMap[(string) $W]
            ?? $widthMap[(string) (float) $W]
            ?? null;

        $weightMap = $p['broiler_weight_birds_map'] ?? $cfgFallback['broiler_weight_birds_map'] ?? [];
        $birdsPerNest = $this->resolveBirdsPerNest($birdWeightKg, $weightMap);

        $nestsPerLine = (int) ($effectiveLength * 2 * $floors);
        $totalNests = $nestsPerLine * $lines;
        $totalBirds = (int) (ceil(($totalNests * $birdsPerNest) / 2) * 2);

        $fanCapacity = (float) ($p['fan_capacity_kg'] ?? $cfgFallback['fan_capacity_kg'] ?? 5000);
        $rearFans = (int) ceil($totalBirds * $birdWeightKg / max(1, $fanCapacity));

        $coolingPadMetersPerFan = (float) ($p['cooling_pad_meters_per_fan'] ?? $cfgFallback['cooling_pad_meters_per_fan'] ?? 5.5);
        $coolingPadMeters = (int) ceil($rearFans * $coolingPadMetersPerFan);

        $inlets = (int) (($L % 2 === 1) ? (($L - 3) / 2) : (($L - 4) / 2));
        $inlets = max(0, $inlets);

        $layerNestModule = (float) ($p['layer_nest_module_m'] ?? $cfgFallback['layer_nest_module_m'] ?? 0.60);
        $layerNestsPerFace = (int) round($effectiveLength / max(0.01, $layerNestModule));
        $layerNestsTotal = $layerNestsPerFace * 2 * $floors;

        return [
            'inputs' => [
                'length' => $L,
                'width'  => $W,
                'height' => $H,
                'floors' => $floors,
                'lines'  => $lines,
                'service_length' => $serviceLength,
            ],
            'service_length'      => $serviceLength,
            'effective_length'    => $effectiveLength,
            'mapped_lines'        => $mappedLines !== null ? (int) $mappedLines : null,
            'birds_per_nest'      => $birdsPerNest,
            'bird_weight_kg'      => $birdWeightKg,
            'bird_weight_grams'   => 2100,
            'fan_spec'            => '140×140 Munters Italy',
            'nests_per_line'      => $nestsPerLine,
            'total_nests'         => $totalNests,
            'birds'               => $totalBirds,
            'rear_fans'           => $rearFans,
            'cooling_pad_meters'  => $coolingPadMeters,
            'inlets'              => $inlets,
            'layer_nests_per_face'=> $layerNestsPerFace,
            'layer_nests_total'   => $layerNestsTotal,
        ];
    }

    /**
     * Resolve birds-per-nest from the weight map.
     * Falls back to closest key if exact match is missing.
     */
    private function resolveBirdsPerNest(float $weight, array $map): int
    {
        $key = (string) $weight;
        if (isset($map[$key])) {
            return (int) $map[$key];
        }

        if (empty($map)) {
            return 16; // safe fallback
        }

        // Find closest weight key
        $closest = null;
        $closestDiff = PHP_FLOAT_MAX;
        foreach ($map as $w => $birds) {
            $diff = abs($w - $weight);
            if ($diff < $closestDiff) {
                $closestDiff = $diff;
                $closest = $birds;
            }
        }

        return (int) $closest;
    }
}
