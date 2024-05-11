<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVaccineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'blister' => 'nullable|string',
            'pill' => 'nullable|string',
            'drops' => 'nullable|string',
            'internal_deworming' => 'nullable|string',
            'external_deworming' => 'nullable|string',
            'date' => 'nullable|date',
            'observations' => 'nullable|string',
        ];
    }
}
