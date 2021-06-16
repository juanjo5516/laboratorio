<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialStoreRequest extends FormRequest
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
            'codigo' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'stock_minimo_viable' => 'required',
            'existencia' => 'required',
            'precio' => 'required',
            'foto' => 'required',
            'unidad_id' => 'required',
            'categoria_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'stock_minimo_viable' => 'stock minimo viable',
            'unidad_id' => 'unidad de medida',
            'categoria_id' => 'categoria',
        ];
    }
}
