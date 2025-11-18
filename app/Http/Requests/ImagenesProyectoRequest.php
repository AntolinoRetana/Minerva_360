<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImagenesProyectoRequest extends FormRequest
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
			'proyecto_id' => 'required',
			'url' => 'required|string',
			'orden' => 'required',
        ];
    }
}
