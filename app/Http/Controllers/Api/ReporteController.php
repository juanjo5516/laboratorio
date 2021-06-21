<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Compra;
use App\Models\Proveedor;
use DB;

class ReporteController extends Controller
{
    /*
    1.
    Un velocímetro indicando el importe de compras del mes
    respecto al presupuesto de compras, este último importe
    sería un parámetro del sistema.
    */
    public function comprasVsPresupuesto(Request $request)
    {
        $compras = DB::table('compras')
        ->where('mes', $request->mes)
        ->sum('total');
        return response()->json($compras, 200);
    }

    /*
    2.
    Un velocímetro indicando la cantidad de pagos realizado
    comparado contra las compras realizadas.
    */
    public function pagosCuentasPorPagar(Request $request)
    {
        $pagos = DB::table('pagos')
        ->where('mes', $request->mes)
        ->sum('monto');
        return response()->json($pagos, 200);
    }

    /*
    3. -no aplica porque no pideron ventas-
    Una gráfica indicando la distribución de ventas por proveedor
    y producto en el mes. (Los principales 10 proveedores)
    */
    public function topComprasPorProveedor(Request $request)
    {
        $top = DB::table('compras AS c')
        ->join('proveedores AS p', 'c.proveedor_id', 'p.id')
        ->where('mes', $request->mes)
        ->select(DB::raw('p.nombre AS proveedor, SUM(c.total) as total'))
        ->groupBy('p.nombre')
        ->orderBy('total', 'DESC')
        ->take(10)
        ->get();

        return response()->json($top, 200);
    }

    /*
    4.
    Una gráfica indicando la distribución de compras por importe en el mes.
    (5 rangos de compras)
    */
    public function distribucionComprasRango(Request $request)
    {
        $rangos = DB::table('compras AS c')
        ->where('mes', $request->mes)
        ->select(DB::raw(
            "CASE WHEN (total BETWEEN 0 AND 1000) THEN 'De 0 a 1,000' ELSE
                CASE WHEN (total BETWEEN 1001 AND 3000) THEN 'De 1,001 a 3,000' ELSE
                    CASE WHEN (total BETWEEN 3001 AND 8000) THEN 'De 3,001 a 8,000' ELSE 
                        CASE WHEN (total BETWEEN 8001 AND 15000) THEN 'De 8,001 a 15,000'
                        ELSE
                            '15,001 en adelante'
                        END
                    END
                END
            END AS rango,
            COUNT(total) AS total"
        ))
        ->groupBy('rango')
        ->get();
        return response()->json($rangos, 200);
    }
}
