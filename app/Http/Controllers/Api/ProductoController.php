<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoStoreRequest;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Producto::get(), 200);
    }

    public function store(ProductoStoreRequest $request)
    {
        $path_foto = $request->foto->store('productos', 'public');

        $material = Producto::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'stock_minimo_viable' => $request->stock_minimo_viable,
            'existencia' => $request->existencia,
            'precio' => $request->precio,
            'foto' => $path_foto,
            'unidad_id' => $request->unidad_id,
            'categoria_id' => $request->categoria_id,
        ]);

        return response()->json($material, 201);
    }

    public function show($id)
    {
        return response()->json(Producto::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $material = Producto::findOrFail($id);

        $path_foto = $material->foto;
        if( $request->hasFile('foto') ) {
            $path_foto = $request->foto->store('productos', 'public');
        }

        $foto_anterior = $material->foto;

        $actualizado = $material->update([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'stock_minimo_viable' => $request->stock_minimo_viable,
            'existencia' => $request->existencia,
            'precio' => $request->precio,
            'foto' => $path_foto ? $path_foto : $material->foto,
            'unidad_id' => $request->unidad_id,
            'categoria_id' => $request->categoria_id,
        ]);

        if($actualizado && $path_foto != null) {
            \Storage::delete($foto_anterior);
        }
        
        return response()->json("Actualizado", 200);
    }

    public function destroy($id)
    {
        Producto::where('id', $id)->delete();
        return response()->json('Deleted', 204);
    }
}
