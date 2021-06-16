<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Unidad::paginate($request->per_page), 200);
    }

    public function store(Request $request)
    {
        return response()->json(Unidad::create($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json(Unidad::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        return response()->json(Unidad::where('id', $id)->update($request->all()), 200);
    }

    public function destroy($id)
    {
        Unidad::where('id', $id)->delete();
        return response()->json('Deleted', 204);
    }
}
