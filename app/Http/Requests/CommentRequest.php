<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'author_name'  => 'required|string|max:120',
            'author_email' => 'required|email|max:255',
            'body'         => 'required|string|min:5|max:3000',
            'parent_id'    => 'nullable|integer|exists:blog_comments,id',
        ];
    }
}
