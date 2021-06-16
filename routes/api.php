<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// rutas para catalogos

Route::/*middleware('auth:api')->*/apiResource('unidades', App\Http\Controllers\Api\UnidadController::class)->parameters(['unidades' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('categorias', App\Http\Controllers\Api\CategoriaController::class)->parameters(['categorias' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('formas', App\Http\Controllers\Api\FormaPagoController::class)->parameters(['formas' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('estados', App\Http\Controllers\Api\EstadoController::class)->parameters(['estados' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('bancos', App\Http\Controllers\Api\BancoController::class)->parameters(['bancos' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('materiales', App\Http\Controllers\Api\MaterialController::class)->parameters(['materiales' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('proveedores', App\Http\Controllers\Api\ProveedorController::class)->parameters(['proveedores' => 'id']);

Route::get('proveedor/search', [App\Http\Controllers\Api\ProveedorController::class, 'search']);

Route::/*middleware('auth:api')->*/apiResource('compras', App\Http\Controllers\Api\CompraController::class)->parameters(['compras' => 'id']);

// rutas para compras_materiales

// rutas para cxc

// rutas para cuentas

// rutas para pagos
