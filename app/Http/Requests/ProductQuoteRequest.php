<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductQuoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'project_id' => ['required', 'exists:projects'],
            'quote_id' => ['required', 'exists:quotes'],
            'product_project_provider_id' => ['required', 'exists:product_project_providers'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
