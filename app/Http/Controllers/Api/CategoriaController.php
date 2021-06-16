<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Categoria::orderBy('id', 'ASC')->paginate($request->per_page, ['id', 'name']), 200);
    }

    public function store(Request $request)
    {
        return response()->json(Categoria::create($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json(Categoria::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        return response()->json(Categoria::where('id', $id)->update($request->all()), 200);
    }

    public function destroy($id)
    {
        Categoria::where('id', $id)->delete();
        return response()->json('Deleted', 204);
    }
}
