<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentabilidadController extends Controller
{
    //
    public function show(Request $request)
    {
        $date = $request->query('date');
        $month = $request->query('month');

        if ($month) {
            $startDate = date('Y-m-01', strtotime($month));
            $endDate = date('Y-m-t', strtotime($month));
        } elseif ($date) {
            $startDate = $date;
            $endDate = $date;
        } else {
            // Si no se proporciona fecha ni mes, use el mes actual
            $startDate = '';
            $endDate = '';
        }

        $productos = Producto::leftJoin('detalle_venta', 'producto.id', '=', 'detalle_venta.producto_id')
            ->leftJoin('venta', 'detalle_venta.venta_id', '=', 'venta.id')
            ->select('producto.*')
            ->selectRaw('COALESCE(SUM(detalle_venta.ganancia), 0) as monto_total')
            ->selectRaw('COALESCE(SUM(detalle_venta.cantidad), 0) as cantidad_total')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('venta.fecha', [$startDate, $endDate]);
            })
            ->groupBy(
                'producto.id',
                'producto.nombre',
                'producto.descripcion',
                'producto.codigo',
                'producto.precio_compra',
                'producto.precio_venta',
                'producto.stok',
                'producto.imagen',
                'producto.estado',
                'producto.categoria_id',
                'producto.medida_id',
                'producto.proveedor_id',
                'producto.sucursal_id'
            )
            ->orderBy('cantidad_total', 'desc')
            ->get();
        return view('rentabilidad.prod', compact('productos', 'startDate', 'endDate'));
    }
    public function filtrarRentabilidad(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $endDate = Carbon::parse($endDate)->endOfDay();
        $productos = Producto::leftJoin('detalle_venta', 'producto.id', '=', 'detalle_venta.producto_id')
            ->leftJoin('venta', 'detalle_venta.venta_id', '=', 'venta.id')
            ->select('producto.*')
            ->selectRaw('COALESCE(SUM(detalle_venta.ganancia), 0) as monto_total')
            ->selectRaw('COALESCE(SUM(detalle_venta.cantidad), 0) as cantidad_total')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('venta.fecha', [$startDate, $endDate]);
            })
            ->groupBy(
                'producto.id',
                'producto.nombre',
                'producto.descripcion',
                'producto.codigo',
                'producto.precio_compra',
                'producto.precio_venta',
                'producto.stok',
                'producto.imagen',
                'producto.estado',
                'producto.categoria_id',
                'producto.medida_id',
                'producto.proveedor_id',
                'producto.sucursal_id'
            )
            ->orderBy('cantidad_total', 'desc')
            ->get();

        return response()->json($productos);
    }
    public function showsito(Request $request)
    {
        $date = $request->query('date');
        $month = $request->query('month');



        if ($month) {
            $startDate = date('Y-m-01', strtotime($month));
            $endDate = date('Y-m-t', strtotime($month));
        }
        //  echo $startDate.'//'.$endDate;
        $productos = Producto::leftJoin('detalle_venta', 'producto.id', '=', 'detalle_venta.producto_id')
            ->leftJoin('venta', 'detalle_venta.venta_id', '=', 'venta.id')
            ->select('producto.*')
            ->selectRaw('COALESCE(SUM(detalle_venta.cantidad * detalle_venta.precio), 0) as monto_total')
            ->selectRaw('COALESCE(SUM(detalle_venta.cantidad), 0) as cantidad_total')
            ->whereBetween(DB::raw('DATE(venta.fecha)'), [$startDate, $endDate]) // Usamos DATE() para asegurarnos de comparar solo las fechas
            ->groupBy(
                'producto.id',
                'producto.nombre',
                'producto.descripcion',
                'producto.codigo',
                'producto.precio_compra',
                'producto.precio_venta',
                'producto.stok',
                'producto.imagen',
                'producto.estado',
                'producto.categoria_id',
                'producto.medida_id',
                'producto.proveedor_id',
                'producto.sucursal_id'
            )
            ->orderBy('cantidad_total', 'desc')
            ->get();
        //return response()->json($productos);
        return view('rentabilidad.predicador', compact('productos', 'startDate', 'endDate'));
    }

    public function showsitoperro(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $endDate = Carbon::parse($endDate)->endOfDay();

        $productos = Producto::leftJoin('detalle_venta', 'producto.id', '=', 'detalle_venta.producto_id')
            ->leftJoin('venta', 'detalle_venta.venta_id', '=', 'venta.id')
            ->select('producto.*')
            ->selectRaw('COALESCE(SUM(detalle_venta.cantidad * detalle_venta.precio), 0) as monto_total')
            ->selectRaw('COALESCE(SUM(detalle_venta.cantidad), 0) as cantidad_total')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('venta.fecha', [$startDate, $endDate]);
            })
            ->groupBy(
                'producto.id',
                'producto.nombre',
                'producto.descripcion',
                'producto.codigo',
                'producto.precio_compra',
                'producto.precio_venta',
                'producto.stok',
                'producto.imagen',
                'producto.estado',
                'producto.categoria_id',
                'producto.medida_id',
                'producto.proveedor_id',
                'producto.sucursal_id'
            )
            ->orderBy('cantidad_total', 'desc')
            ->get();

        return response()->json($productos);
        // return view('rentabilidad.predicador', compact('productos', 'startDate', 'endDate'));
    }
}
