<?php

namespace App\Actions;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class StoreContactSubmission
{
    public function handle(array $data, Request $request): ContactSubmission
    {
        return ContactSubmission::create([
            ...$data,
            'locale'     => app()->getLocale(),
            'ip_address' => $request->ip(),
            'status'     => 'new',
        ]);
    }
}
