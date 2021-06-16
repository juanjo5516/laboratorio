<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banco;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Banco::orderBy('id', 'ASC')->paginate($request->per_page, ['id', 'name']), 200);
    }

    public function store(Request $request)
    {
        return response()->json(Banco::create($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json(Banco::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        return response()->json(Banco::where('id', $id)->update($request->all()), 200);
    }

    public function destroy($id)
    {
        Banco::where('id', $id)->delete();
        return response()->json('Deleted', 204);
    }
}
