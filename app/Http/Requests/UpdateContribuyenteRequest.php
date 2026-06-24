<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateContribuyenteRequest extends FormRequest
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
        $contribuyenteId = Auth::user()->contribuyente->id;

        return [
            'nombres_razon_social' => ['sometimes', 'string', 'max:100',
                                        Rule::unique('contribuyentes')->ignore($contribuyenteId)],
            'dni_ruc' => ['sometimes','string','max:10',
                            Rule::unique('contribuyentes')->ignore($contribuyenteId)],
            'direccion_fiscal' => ['sometimes','string','max:100',
                            Rule::unique('contribuyentes')->ignore($contribuyenteId)]
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
