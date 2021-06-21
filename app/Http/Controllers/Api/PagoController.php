<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Cxc;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->tipo == 'cheque') {
            $pagos = Pago::
            join('cuentas AS c2', 'pagos.cuenta_id', 'c2.id')
            ->join('bancos AS b', 'c2.banco_id', 'b.id')
            ->get([
                'pagos.id',
                'pagos.beneficiario',
                'pagos.monto',
                'c2.numero AS cuenta',
                'b.name AS banco'
            ]);
        } else {
            $pagos = Pago::
            leftJoin('cuentas AS c2', 'pagos.cuenta_id', 'c2.id')
            ->leftJoin('bancos AS b', 'c2.banco_id', 'b.id')
            ->get([
                'pagos.id',
                'pagos.beneficiario',
                'pagos.monto',
                'c2.numero AS cuenta',
                'b.name AS banco'
            ]);
        }

        return response()->json($pagos, 200);
    }

    public function show($id)
    {
        return response()->json(Pago::findOrFail($id), 200);
    }
}
