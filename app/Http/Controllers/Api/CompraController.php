<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CompraStoreRequest;
use App\Models\Compra;
use App\Models\CompraProducto;
use App\Models\Cxc;
use App\Models\Pago;
use DB;

class CompraController extends Controller
{
    public function index()
    {
        return response()->json(Compra::
            join('proveedores AS p', 'compras.proveedor_id', 'p.id')
            ->join('forma_pagos AS fp', 'compras.forma_pago_id', 'fp.id')
            ->orderBy('compras.id')
            ->get([
                'compras.id',
                'compras.factura',
                'compras.total',
                'compras.created_at',
                'p.nombre AS proveedor',
                'fp.name AS forma_pago'
            ]), 200);
    }

    public function store(CompraStoreRequest $request)
    {
        $total_presupuesto = DB::table('presupuesto_detalle')
        ->where('presupuesto_id', 1)
        ->where('mes', date('m'))
        ->sum('monto');

        $total_compras = DB::table('compras')
        ->where('mes', date('m'))
        ->sum('total');

        $saldo = $total_presupuesto - $total_compras;

        if($request->total > $saldo) {
            return response()->json("Saldo insuficiente para registrar la compra. El presupuesto actual tiene un saldo de: $saldo", 403);
        }
        DB::beginTransaction();
        try {
            $compra = Compra::create([
                'factura' => $request->factura,
                'total' => $request->total,
                'proveedor_id' => $request->proveedor_id,
                'forma_pago_id' => $request->forma_pago_id,
                'mes' => date('m')
            ]);

            foreach ($request->productos as $producto) {
                CompraProducto::create([
                    'cantidad' => $producto['cantidad'],
                    'precio' => $producto['precio'],
                    'compra_id' => $compra->id,
                    'producto_id' => $producto['id']
                ]);

                DB::table('productos')->increment(
                    'existencia', $producto['cantidad'],
                    [
                        'precio' => $producto['precio']
                    ]
                );
            }

            if($compra->forma_pago_id == 2) {
                Cxc::create([
                    'plazo' => 0,
                    'fecha_pago' => $request->fecha_pago,
                    'compra_id' => $compra->id,
                    'estado_id' => 1,
                    'mes' => date('m')
                ]);
            } else {
                Pago::create([
                    'beneficiario' => $request->proveedor,
                    'monto' => $request->total,
                    'compra_id' => $compra->id,
                    'mes' => date('m')
                ]);
            }

            DB::commit();
            return response()->json("Compra registrada", 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        return response()->json(Compra::
            join('proveedores AS p', 'compras.proveedor_id', 'p.id')
            ->join('forma_pagos AS fp', 'compras.forma_pago_id', 'fp.id')
            ->findOrFail($id, [
                'compras.id',
                'compras.factura',
                'compras.total',
                'p.nombre AS proveedor',
                'fp.name AS forma_pago',
                'compras.created_at'
            ]), 200);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function productos($id)
    {
        return response()->json(Compra::findOrFail($id)
            ->productos, 200);
    }
}
