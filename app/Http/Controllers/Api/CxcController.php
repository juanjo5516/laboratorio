<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cxc;
use App\Models\Pago;
use DB;

class CxcController extends Controller
{
    public function index()
    {
        return response()->json(Cxc::
            join('compras AS c', 'cxc.compra_id', 'c.id')
            ->join('proveedores AS p', 'c.proveedor_id', 'p.id')
            ->where('cxc.estado_id', 1)
            ->orderBy('fecha_pago', 'ASC')
            ->get([
                'cxc.id',
                'cxc.plazo',
                'cxc.fecha_pago',
                'c.factura',
                'c.total',
                'p.nombre AS proveedor'
            ]), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Cxc::
            join('compras AS c', 'cxc.compra_id', 'c.id')
            ->join('proveedores AS p', 'c.proveedor_id', 'p.id')
            ->findOrFail($id, [
                'cxc.id',
                'cxc.plazo',
                'cxc.fecha_pago',
                'cxc.compra_id',
                'c.factura',
                'c.total',
                'p.nombre AS proveedor'
            ]), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generarCheque(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $pago = Pago::create([
                'beneficiario' => $request->beneficiario,
                'monto' => $request->monto,
                'compra_id' => $request->compra_id,
                'cuenta_id' => $request->cuenta_id,
                'mes' => date('m')
            ]);

            Cxc::where('id', $id)->update(['estado_id' => 3]);
            DB::commit();
            return response()->json($pago, 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
        
    }
}
