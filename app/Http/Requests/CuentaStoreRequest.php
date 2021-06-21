<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuentaStoreRequest extends FormRequest
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
            'numero' => 'required|unique:cuentas,numero,banco_id',
            'banco_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'numero' => 'número de cuenta bancaria',
            'banco_id' => 'banco'
        ];
    }

    public function messages()
    {
        return [
            'numero.unique' => 'El :attribute :input ya se encuentra registrado en la base de datos'
        ];
    }
}
