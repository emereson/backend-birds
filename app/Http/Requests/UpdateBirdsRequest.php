<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBirdsRequest extends FormRequest
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
            'plate_color_id' => 'required',
            'plate_number' => 'required',
            'sex' => 'required',
            'father_bird_id' => 'required',
            'mother_bird_id' => 'required',
            'birthdate' => 'required',
            'bird_color' => 'required',
            'crest_type' => 'required',
            'line' => 'required',
            'weight' => 'required',
            'status' => 'required',
            'origin' => 'required',
            'observations' => 'required',
        ];
    }
    
}
