<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nit' => 'required|unique:proveedores,nit',
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|regex:/^\d{8,8}$/i',
            'email' => 'required|email'
        ];
    }

    public function attributes()
    {
        return [
            'direccion' => 'dirección',
            'telefono' => 'teléfono',
            'email' => 'correo electrónico'
        ];
    }

    public function messages()
    {
        return [
            'nit.unique' => 'El :attribute :input ya está registrado en la base de datos',
            'telefono.regex' => 'El formato del campo :attribute es 12345678'
        ];
    }
}
