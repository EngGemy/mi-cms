<?php

namespace App\Services\Contracts;

interface CalculatorServiceInterface
{
    /**
     * Compute the full price breakdown for a given poultry house spec.
     *
     * @param  array{length:float,width:float,height:float,floors:int,lines:int}  $input
     * @return array  full breakdown ready for view/JSON
     */
    public function compute(array $input): array;

    /**
     * Compute capacity-only breakdown (no financial values).
     *
     * @param  array{length:float,width:float,height:float,floors:int,lines:int}  $input
     * @return array  capacity + technical breakdown
     */
    public function computeCapacity(array $input): array;
}
