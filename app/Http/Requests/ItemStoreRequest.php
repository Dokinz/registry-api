<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'item' => 'required|string|regex:/^[A-Za-z0-9 ]+$/'
        ];
    }

    public function messages(): array
    {
        return [
            'item.required' => 'The "item" field is required and cannot be empty.',
            'item.regex' => 'The "item" field may only contain letters, numbers, and spaces.',
        ];
    }
}
