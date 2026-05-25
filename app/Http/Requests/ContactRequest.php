<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:32',
            'company'    => 'nullable|string|max:255',
            'flock_size' => 'nullable|string|max:64',
            'message'    => 'nullable|string|max:5000',
        ];
    }
}
