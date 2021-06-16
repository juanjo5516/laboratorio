<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Estado::orderBy('id', 'ASC')->paginate($request->per_page, ['id', 'name']), 200);
    }

    public function store(Request $request)
    {
        return response()->json(Estado::create($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json(Estado::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        return response()->json(Estado::where('id', $id)->update($request->all()), 200);
    }

    public function destroy($id)
    {
        Estado::where('id', $id)->delete();
        return response()->json('Deleted', 204);
    }
}
