<?php

namespace App\Actions;

use App\Models\CalculatorRequest;
use App\Services\Contracts\CalculatorServiceInterface;
use Illuminate\Http\Request;

class CreateCalculatorEstimate
{
    public function __construct(
        private readonly CalculatorServiceInterface $calculator,
    ) {}

    public function handle(array $input, Request $request): array
    {
        $breakdown = $this->calculator->compute($input);

        $stored = CalculatorRequest::create([
            'length'      => $input['length'],
            'width'       => $input['width'],
            'height'      => $input['height'],
            'floors'      => $input['floors'],
            'lines'       => $input['lines'],
            'bird_count'  => $breakdown['birds'],
            'grand_total' => $breakdown['grand_total'],
            'breakdown'   => $breakdown,
            'locale'      => app()->getLocale(),
            'ip_address'  => $request->ip(),
        ]);

        return [
            'request_id' => $stored->id,
            'breakdown'  => $breakdown,
        ];
    }
}
