<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImagenesProyectoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'proyecto_id' => 'required|integer',
            'imagen' => 'required|file|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }
}
