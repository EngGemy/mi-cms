<?php

namespace App\Livewire;

use App\Actions\CreateCalculatorEstimate;
use App\Services\Contracts\CalculatorServiceInterface;
use App\Settings\CalculatorSettings;
use Livewire\Component;

class PriceCalculator extends Component
{
    public float $length = 81;
    public float $width = 12;
    public float $height = 3.5;
    public int $floors = 3;
    public int $lines = 4;

    public array $breakdown = [];

    public function mount(): void
    {
        $this->recompute();
    }

    public function recompute(): void
    {
        $this->breakdown = app(CalculatorServiceInterface::class)->computeCapacity([
            'length' => $this->length,
            'width'  => $this->width,
            'height' => $this->height,
            'floors' => $this->floors,
            'lines'  => $this->lines,
        ]);
    }

    /**
     * Sync client-side Alpine values then persist — one request only (avoids CSRF spam on sliders).
     */
    public function syncAndPersist(array $data, CreateCalculatorEstimate $action): void
    {
        $this->length = (float) ($data['length'] ?? $this->length);
        $this->width  = (float) ($data['width'] ?? $this->width);
        $this->height = (float) ($data['height'] ?? $this->height);
        $this->floors = (int) ($data['floors'] ?? $this->floors);
        $this->lines  = (int) ($data['lines'] ?? $this->lines);

        $this->validate([
            'length' => 'numeric|min:81|max:300',
            'width'  => 'numeric|min:8|max:30',
            'height' => 'numeric|min:3|max:6',
            'floors' => 'integer|in:1,2,3,4,5',
            'lines'  => 'integer|in:3,4,5,6',
        ]);

        $this->recompute();

        $result = $action->handle([
            'length' => $this->length,
            'width'  => $this->width,
            'height' => $this->height,
            'floors' => $this->floors,
            'lines'  => $this->lines,
        ], request());

        $this->dispatch('calculator-persisted', requestId: $result['request_id']);
        session()->flash('calc_ok', __('messages.calc_saved'));
    }

    public function getAlpineConfigProperty(): array
    {
        $settings = app(CalculatorSettings::class);
        $tech = config('poultry_pricing', []);

        return [
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'floors' => $this->floors,
            'lines' => $this->lines,
            'serviceLength' => (float) ($tech['default_service_length'] ?? 10),
            'birdWeightKg' => (float) ($settings->bird_weight_kg ?? 2.1),
            'fanCapacityKg' => (float) ($tech['fan_capacity_kg'] ?? 5000),
            'coolingPadMetersPerFan' => (float) ($tech['cooling_pad_meters_per_fan'] ?? 5.5),
            'layerNestModuleM' => (float) ($tech['layer_nest_module_m'] ?? 0.60),
            'widthLinesMap' => $tech['width_lines_map'] ?? [],
            'weightMap' => $tech['broiler_weight_birds_map'] ?? [],
            'locale' => app()->getLocale(),
        ];
    }

    public function render()
    {
        return view('livewire.price-calculator', [
            'alpineConfig' => $this->alpineConfig,
        ]);
    }
}
