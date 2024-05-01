<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBirdImagesRequest extends FormRequest
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
            'link_image' => 'required|image|mimes:jpeg,png,jpg,gif', // La imagen debe ser requerida, tener un formato de imagen válido, y no superar los 2MB
            'bird_id' => 'required|exists:birds,id', // El bird_id debe ser requerido y existir en la tabla birds
        ];
    }
}
