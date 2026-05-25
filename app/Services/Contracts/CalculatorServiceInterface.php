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
}
