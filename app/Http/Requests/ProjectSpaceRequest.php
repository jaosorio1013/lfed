<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectSpaceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'measures' => ['nullable', 'numeric'],
            'approved' => ['boolean'],
            'project_id' => ['required', 'exists:projects'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
