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
            'plate_color_id',
            'plate_number',
            'sex',
            'father_bird_id',
            'mother_bird_id',
            'birthdate',
            'bird_color', 
            'crest_type',
            'line',
            'weight',
            'status',
            'origin',
            'observations',
            'in_care'
        ];
    }
}
