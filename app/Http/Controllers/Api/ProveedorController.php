<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProveedorStoreRequest;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Proveedor::get(), 200);
    }

    public function store(ProveedorStoreRequest $request)
    {
        $proveedor = Proveedor::create([
            'nit' => $request->nit,
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email
        ]);

        return response()->json($proveedor, 201);
    }

    public function show($id)
    {
        return response()->json(Proveedor::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        Proveedor::where('id', $id)->update([
            'nit' => $request->nit,
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email
        ]);
        
        return response()->json("Actualizado", 200);
    }

    public function destroy($id)
    {
        Proveedor::where('id', $id)->delete();
        return response()->json('Deleted', 204);
    }

    public function search(Request $request)
    {
        return response()->json(Proveedor::where('nit', $request->nit)
            ->firstOrFail(), 200);
    }
}
