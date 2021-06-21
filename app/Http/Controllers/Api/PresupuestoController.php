<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PresupuestoStoreRequest;
use App\Models\Presupuesto;

class PresupuestoController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Presupuesto::get(), 200);
    }

    public function store(PresupuestoStoreRequest $request)
    {
        $proveedor = Presupuesto::create([
            'periodo' => $request->periodo,
            'monto' => $request->monto
        ]);

        return response()->json($proveedor, 201);
    }

    public function show($id)
    {
        return response()->json(Presupuesto::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        Presupuesto::where('id', $id)->update([
            'periodo' => $request->periodo,
            'monto' => $request->monto
        ]);
        
        return response()->json("Actualizado", 200);
    }

    public function destroy($id)
    {
        Presupuesto::where('id', $id)->delete();
        return response()->json('Deleted', 204);
    }
}
