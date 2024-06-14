<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'identification_type' => ['required', 'integer'],
            'identification_number' => ['required'],
            'name' => ['required'],
            'phone' => ['required'],
            'email' => ['nullable', 'email', 'max:254'],
            'address' => ['nullable'],
            'is_provider' => ['boolean', 'nullable'],
            'is_client' => ['boolean', 'nullable'],
            'is_active' => ['boolean', 'nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
