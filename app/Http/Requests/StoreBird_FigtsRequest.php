<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBird_FigtsRequest extends FormRequest
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
            'number_fight' => 'required',
            'coliseum' => 'required',
            'opponent' => 'required',
            'weight' => 'required',
            'date_fight' => 'required',
            'minutes' => 'required',
            'state' => 'required',
            'bird_id' => 'required',

            
        ];
    }
}
