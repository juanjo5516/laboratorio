<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FormaPago;
use Illuminate\Http\Request;

class FormaPagoController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(FormaPago::orderBy('id', 'ASC')->paginate($request->per_page, ['id', 'name']), 200);
    }

    public function store(Request $request)
    {
        return response()->json(FormaPago::create($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json(FormaPago::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        return response()->json(FormaPago::where('id', $id)->update($request->all()), 200);
    }

    public function destroy($id)
    {
        FormaPago::where('id', $id)->delete();
        return response()->json('Deleted', 204);
    }
}
