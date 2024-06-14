<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'project_id' => ['required', 'exists:projects'],
            'identification' => ['required'],
            'subtotal' => ['nullable', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'percentage_utilidad' => ['nullable', 'numeric'],
            'percentage_administracion' => ['nullable', 'numeric'],
            'percentage_inprevistos' => ['nullable', 'numeric'],
            'percentage_retefuente' => ['nullable', 'numeric'],
            'valid_until' => ['required', 'date'],
            'sent_at' => ['nullable', 'date'],
            'approved_at' => ['nullable', 'date'],
            'rejected_at' => ['nullable', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
