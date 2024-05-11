<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBird_FigtsRequest extends FormRequest
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
            'number_fight' => 'required|string',
            'coliseum' => 'required|string',
            'opponent' => 'required|string',
            'weight' => 'required|string',
            'date_fight' => 'required|date',
            'minutes' => 'required|string',
            'state' => 'required|string',
            'observations' => 'nullable|string',
        ];
    }
}
