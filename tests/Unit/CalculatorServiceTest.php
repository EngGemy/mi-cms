<?php

namespace Tests\Unit;

use App\Services\CalculatorService;
use PHPUnit\Framework\TestCase;

/**
 * Tests the calculator against MI's reference: 81×12×3.5 house, 3 floors, 4 lines.
 * Formulas come from MI's pricing methodology.
 */
class CalculatorServiceTest extends TestCase
{
    private array $prices = [
        'concrete_m2'    => 2800,
        'steel_m2'       => 4200,
        'walls_m2'       => 2400,
        'tanks_fixed'    => 95000,
        'bird_cost'      => 220,
        'rear_fan'       => 42000,
        'cooling_factor' => 5500,
        'window'         => 4800,
        'side_fan'       => 35000,
        'heater'         => 26000,
        'control_fixed'  => 110000,
        'bird_weight_kg' => 2.1,
    ];

    private function svc(): CalculatorService
    {
        return new CalculatorService($this->prices);
    }

    private function input(float $L, float $W, float $H, int $floors, int $lines): array
    {
        return [
            'length' => $L,
            'width'  => $W,
            'height' => $H,
            'floors' => $floors,
            'lines'  => $lines,
        ];
    }

    public function test_reference_house_bird_count(): void
    {
        // (81-4) × 2 × 3 × 4 × 16 = 29,568
        $result = $this->svc()->compute($this->input(81, 12, 3.5, 3, 4));
        $this->assertSame(29568, $result['birds']);
    }

    public function test_construction_matches_formula(): void
    {
        $result = $this->svc()->compute($this->input(81, 12, 3.5, 3, 4));
        $c = $result['construction'];

        $this->assertEquals(81 * 12 * 2800, $c['concrete']);
        $this->assertEquals(81 * 12 * 4200, $c['steel']);
        $this->assertEquals(81 * 3.5 * 2 * 2400, $c['walls']);
        $this->assertSame(95000, $c['tanks']);
    }

    public function test_battery_cost_equals_birds_times_unit(): void
    {
        $result = $this->svc()->compute($this->input(81, 12, 3.5, 3, 4));
        $this->assertSame(29568 * 220, $result['battery']['total']);
    }

    public function test_accessories_thresholds_by_house_length(): void
    {
        $svc = $this->svc();

        $small = $svc->compute($this->input(50, 12, 3, 3, 3));
        $this->assertSame(6, $small['accessories']['side_fans']['count']);
        $this->assertSame(2, $small['accessories']['heaters']['count']);

        $medium = $svc->compute($this->input(81, 12, 3.5, 3, 4));
        $this->assertSame(8, $medium['accessories']['side_fans']['count']);
        $this->assertSame(4, $medium['accessories']['heaters']['count']);

        $large = $svc->compute($this->input(120, 14, 4, 4, 5));
        $this->assertSame(10, $large['accessories']['side_fans']['count']);
        $this->assertSame(6, $large['accessories']['heaters']['count']);
    }

    public function test_rear_fans_use_ceiling_of_bird_weight_per_5000(): void
    {
        $result = $this->svc()->compute($this->input(81, 12, 3.5, 3, 4));
        // ceil(29568 × 2.1 / 5000) = ceil(12.418...) = 13
        $this->assertSame(13, $result['accessories']['rear_fans']['count']);
    }

    public function test_grand_total_equals_sum_of_three_buckets(): void
    {
        $result = $this->svc()->compute($this->input(81, 12, 3.5, 3, 4));

        $sum = $result['construction']['total']
            + $result['battery']['total']
            + $result['accessories']['total'];

        $this->assertSame($sum, $result['grand_total']);
    }
}
