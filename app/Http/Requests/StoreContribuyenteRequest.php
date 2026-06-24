<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContribuyenteRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Chequear las validaciones
        return [
            'nombres_razon_social' => 'required|string|unique:contribuyentes',
            'dni_ruc' => 'required|string|max:10|unique:contribuyentes',
            'direccion_fiscal' => 'required|string|max:100|unique:contribuyentes'
        ];
    }

    public function messages()
    {
        // Completar los mensajes de excepción
        return [
            'nombre_razon_social.required' => 'El nombre de la razon social es obligatoria'
        ];
    }
}
