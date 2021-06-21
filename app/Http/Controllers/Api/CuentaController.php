<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CuentaStoreRequest;
use App\Models\Cuenta;

class CuentaController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Cuenta::
            join('bancos as b', 'cuentas.banco_id', 'b.id')
            ->get([
                'cuentas.id',
                'cuentas.numero',
                'b.name AS banco'
            ]), 200);
    }

    public function store(CuentaStoreRequest $request)
    {
        $cuenta = Cuenta::create([
            'numero' => $request->numero,
            'banco_id' => $request->banco_id
        ]);

        return response()->json($cuenta, 201);
    }

    public function show($id)
    {
        return response()->json(Cuenta::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        Cuenta::where('id', $id)->update([
            'numero' => $request->numero,
            'banco_id' => $request->banco_id
        ]);
        
        return response()->json("Actualizado", 200);
    }

    public function destroy($id)
    {
        Cuenta::where('id', $id)->delete();
        return response()->json('Deleted', 204);
    }
}
