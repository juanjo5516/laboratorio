<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PresupuestoDetalleStoreRequest;
use App\Models\PresupuestoDetalle;

class PresupuestoDetalleController extends Controller
{
    public function index(Request $request, $id)
    {
        return response()->json(PresupuestoDetalle::where('presupuesto_id', $id)->get(), 200);
    }

    public function store(PresupuestoDetalleStoreRequest $request, $presupuesto_id)
    {
        $proveedor = PresupuestoDetalle::create([
            'mes' => $request->mes,
            'monto' => $request->monto,
            'presupuesto_id' => $presupuesto_id
        ]);

        return response()->json($proveedor, 201);
    }

    public function show($id, $mes_id)
    {
        return response()->json(PresupuestoDetalle::findOrFail($mes_id), 200);
    }

    public function update(Request $request, $id, $mes_id)
    {
        PresupuestoDetalle::where('id', $mes_id)->update([
            'monto' => $request->monto
        ]);
        
        return response()->json("Actualizado", 200);
    }

    public function destroy($id, $mes_id)
    {
        PresupuestoDetalle::where('id', $mes_id)->delete();
        return response()->json('Deleted', 204);
    }
}
