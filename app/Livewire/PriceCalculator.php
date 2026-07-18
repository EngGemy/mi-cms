<?php

namespace App\Livewire;

use App\Actions\CreateCalculatorEstimate;
use App\Services\Contracts\CalculatorServiceInterface;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PriceCalculator extends Component
{
    #[Validate('numeric|min:81|max:300')]
    public float $length = 81;

    #[Validate('numeric|min:8|max:30')]
    public float $width = 12;

    #[Validate('numeric|min:3|max:6')]
    public float $height = 3.5;

    #[Validate('integer|in:1,2,3,4,5')]
    public int $floors = 3;

    #[Validate('integer|in:3,4,5,6')]
    public int $lines = 4;

    public array $breakdown = [];

    public function mount(): void
    {
        $this->recompute();
    }

    public function updatedWidth(): void
    {
        $map = config('poultry_pricing.width_lines_map', []);
        if (isset($map[(string) $this->width])) {
            $this->lines = $map[(string) $this->width];
        }
    }

    public function recompute(): void
    {
        $calculator = app(CalculatorServiceInterface::class);
        $this->breakdown = $calculator->computeCapacity([
            'length' => $this->length,
            'width'  => $this->width,
            'height' => $this->height,
            'floors' => $this->floors,
            'lines'  => $this->lines,
        ]);
    }

    public function persist(CreateCalculatorEstimate $action): void
    {
        $this->validate();

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

    public function render()
    {
        $this->recompute();
        return view('livewire.price-calculator');
    }
}
