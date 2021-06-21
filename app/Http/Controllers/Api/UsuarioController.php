<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UsuarioStoreRequest;
use App\Models\User;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(User::get(), 200);
    }

    public function store(UsuarioStoreRequest $request)
    {
        $proveedor = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        return response()->json($proveedor, 201);
    }

    public function show($id)
    {
        return response()->json(User::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        if($request->password == null) {
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id
            ]);
            return response()->json("Actualizado", 200);
        }
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'role_id' => $request->role_id
        ]);
        
        return response()->json("Actualizado", 200);
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return response()->json('Deleted', 204);
    }

    public function search(Request $request)
    {
        return response()->json(User::where('nit', $request->nit)
            ->firstOrFail(), 200);
    }
}
