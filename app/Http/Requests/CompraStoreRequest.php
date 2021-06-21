<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraStoreRequest extends FormRequest
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
            'factura' => 'required|unique:compras,factura,proveedor_id',
            'total' => 'required',
            'proveedor_id' => 'required',
            'forma_pago_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'factura.unique' => 'La :attribute :input ya se encuentra registrada en la base datos.'
        ];
    }
}
