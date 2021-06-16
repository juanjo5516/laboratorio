<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SPAController extends Controller
{
    public function app(Request $request)
    {
        $user = $request->user();
        return view('layouts.adminlte', compact('user'));
    }
}
