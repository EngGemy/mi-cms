<?php

namespace App\Http\Controllers;

use App\Actions\CreateCalculatorEstimate;
use App\Settings\CalculatorSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CalculatorEstimateController extends Controller
{
    public function store(
        Request $request,
        CreateCalculatorEstimate $action,
        CalculatorSettings $settings,
    ): JsonResponse {
        $tech = $settings->techConfig();
        $floorsOptions = $tech['floors_options'] ?: [1, 2, 3, 4, 5];
        $linesOptions = $tech['lines_options'] ?: [3, 4, 5, 6];

        try {
            $validated = $request->validate(
                [
                    'length' => ['required', 'numeric', 'min:'.$tech['min_length'], 'max:'.$tech['max_length']],
                    'width' => ['required', 'numeric', 'min:'.$tech['min_width'], 'max:'.$tech['max_width']],
                    'height' => ['required', 'numeric', 'min:'.$tech['min_height'], 'max:'.$tech['max_height']],
                    'floors' => ['required', 'integer', Rule::in($floorsOptions)],
                    'lines' => ['required', 'integer', Rule::in($linesOptions)],
                    'name' => ['required', 'string', 'min:2', 'max:100'],
                    'phone' => ['required', 'string', 'min:8', 'max:30'],
                ],
                [],
                [
                    'name' => __('messages.field_name'),
                    'phone' => __('messages.field_phone'),
                ]
            );
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        }

        $result = $action->handle([
            'length' => (float) $validated['length'],
            'width' => (float) $validated['width'],
            'height' => (float) $validated['height'],
            'floors' => (int) $validated['floors'],
            'lines' => (int) $validated['lines'],
            'name' => trim($validated['name']),
            'phone' => trim($validated['phone']),
        ], $request);

        $breakdown = $result['breakdown'] ?? [];

        return response()->json([
            'requestId' => (int) $result['request_id'],
            'message' => __('messages.calc_saved'),
            'birds' => (int) ($breakdown['birds'] ?? 0),
            'breakdown' => $breakdown,
        ]);
    }
}
