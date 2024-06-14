<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'won_at' => ['nullable', 'date'],
            'lost_at' => ['nullable', 'date'],
            'started_at' => ['nullable', 'date'],
            'finished_at' => ['nullable', 'date'],
            'client_id' => ['required', 'exists:people'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
