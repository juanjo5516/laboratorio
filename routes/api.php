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

Route::/*middleware('auth:api')->*/apiResource('usuarios', App\Http\Controllers\Api\UsuarioController::class)->parameters(['usuarios' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('unidades', App\Http\Controllers\Api\UnidadController::class)->parameters(['unidades' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('categorias', App\Http\Controllers\Api\CategoriaController::class)->parameters(['categorias' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('formas', App\Http\Controllers\Api\FormaPagoController::class)->parameters(['formas' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('estados', App\Http\Controllers\Api\EstadoController::class)->parameters(['estados' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('bancos', App\Http\Controllers\Api\BancoController::class)->parameters(['bancos' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('productos', App\Http\Controllers\Api\ProductoController::class)->parameters(['productos' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('presupuestos', App\Http\Controllers\Api\PresupuestoController::class)->parameters(['presupuestos' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('presupuestos.mes', App\Http\Controllers\Api\PresupuestoDetalleController::class)->parameters(['presupuestos' => 'id', 'mes' => 'mes_id']);

Route::/*middleware('auth:api')->*/apiResource('proveedores', App\Http\Controllers\Api\ProveedorController::class)->parameters(['proveedores' => 'id']);

Route::get('proveedor/search', [App\Http\Controllers\Api\ProveedorController::class, 'search']);

Route::/*middleware('auth:api')->*/apiResource('compras', App\Http\Controllers\Api\CompraController::class)->parameters(['compras' => 'id']);

Route::get('compras/{id}/productos', [App\Http\Controllers\Api\CompraController::class, 'productos']);

Route::/*middleware('auth:api')->*/apiResource('cxc', App\Http\Controllers\Api\CxcController::class)->parameters(['cxc' => 'id']);

Route::post('cxc/{id}/cheque', [App\Http\Controllers\Api\CxcController::class, 'generarCheque']);

Route::/*middleware('auth:api')->*/apiResource('cuentas', App\Http\Controllers\Api\CuentaController::class)->parameters(['cuentas' => 'id']);

Route::/*middleware('auth:api')->*/apiResource('pagos', App\Http\Controllers\Api\PagoController::class)->parameters(['pagos' => 'id']);

Route::get('compras-vs-presupuesto', [App\Http\Controllers\Api\ReporteController::class, 'comprasVsPresupuesto']);

Route::get('pagos-vs-compras', [App\Http\Controllers\Api\ReporteController::class, 'pagosCuentasPorPagar']);

Route::get('top-10-compras', [App\Http\Controllers\Api\ReporteController::class, 'topComprasPorProveedor']);

Route::get('rangos', [App\Http\Controllers\Api\ReporteController::class, 'distribucionComprasRango']);