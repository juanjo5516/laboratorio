<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Requests\MaterialStoreRequest;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Material::orderBy('id', 'DESC')->get(), 200);
    }

    public function store(MaterialStoreRequest $request)
    {
        $path_foto = $request->foto->store('materiales', 'public');

        $material = Material::create([
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
        return response()->json(Material::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        if( $request->hasFile('foto') ) {
            global $path_foto;
            $path_foto = $request->foto->store('materiales', 'public');
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
        Material::where('id', $id)->delete();
        return response()->json('Deleted', 204);
    }
}
