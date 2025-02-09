<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'diff' => 'required|array|min:1',
            'diff.*' => 'string|regex:/^[A-Za-z0-9 ]+$/'
        ];
    }

    public function messages(): array
    {
        return [
            'diff.required' => 'The "diff" field is required and cannot be empty.',
            'diff.array' => 'The "diff" field must be an array of strings.',
            'diff.min' => 'The "diff" array must contain at least one item.',
            'diff.*.string' => 'Each item in "diff" must be a string.',
            'diff.*.regex' => 'Each item in "diff" may only contain letters, numbers, and spaces. Special characters are not allowed.'
        ];
    }
}
