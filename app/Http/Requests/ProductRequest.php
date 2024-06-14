<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'product_category_id' => ['required', 'exists:product_categories'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
