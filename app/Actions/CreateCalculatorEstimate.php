<?php

namespace App\Actions;

use App\Models\CalculatorRequest;
use App\Models\ContactSubmission;
use App\Services\Contracts\CalculatorServiceInterface;
use Illuminate\Http\Request;

class CreateCalculatorEstimate
{
    public function __construct(
        private readonly CalculatorServiceInterface $calculator,
    ) {}

    public function handle(array $input, Request $request): array
    {
        $breakdown = $this->calculator->computeCapacity($input);

        $contactId = null;
        $name = trim((string) ($input['name'] ?? ''));
        $phone = trim((string) ($input['phone'] ?? ''));

        if ($name !== '' && $phone !== '') {
            $birds = (int) ($breakdown['birds'] ?? 0);
            $contact = ContactSubmission::create([
                'name'       => $name,
                'email'      => '',
                'phone'      => $phone,
                'flock_size' => $birds > 0 ? (string) $birds : null,
                'message'    => sprintf(
                    'Calculator estimate — L:%s W:%s H:%s floors:%s lines:%s birds:%s',
                    $input['length'] ?? '',
                    $input['width'] ?? '',
                    $input['height'] ?? '',
                    $input['floors'] ?? '',
                    $input['lines'] ?? '',
                    $birds
                ),
                'locale'     => app()->getLocale(),
                'ip_address' => $request->ip(),
                'status'     => 'new',
            ]);
            $contactId = $contact->id;
        }

        $stored = CalculatorRequest::create([
            'contact_submission_id' => $contactId,
            'length'      => $input['length'],
            'width'       => $input['width'],
            'height'      => $input['height'],
            'floors'      => $input['floors'],
            'lines'       => $input['lines'],
            'bird_count'  => $breakdown['birds'],
            'grand_total' => null,
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
