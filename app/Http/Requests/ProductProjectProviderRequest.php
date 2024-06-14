<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductProjectProviderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'project_id' => ['required', 'exists:projects'],
            'project_space_id' => ['nullable', 'exists:project_spaces'],
            'provider_id' => ['required', 'exists:people'],
            'parent_id' => ['nullable', 'exists:product_project_providers'],
            'product_id' => ['required', 'exists:products'],
            'product_category_id' => ['required', 'exists:product_categories'],
            'has_materiales' => ['boolean'],
            'has_transporte' => ['boolean'],
            'has_suministro' => ['boolean'],
            'has_instalacion' => ['boolean'],
            'quantity' => ['nullable', 'numeric'],
            'price_per_unit' => ['nullable', 'numeric'],
            'total' => ['nullable', 'numeric'],
            'valid_until' => ['nullable', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
