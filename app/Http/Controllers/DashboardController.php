<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Empresa;
use App\Models\Instalacion;
use App\Models\Pago;
use App\Models\PagoPendiente;
use App\Models\Pos;
use App\Models\Producto;
use App\Models\Suspendido;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function show()
    {
        $mesActual = Carbon::now()->month;
        $añoActual = Carbon::now()->year;
        $fechaHoy = Carbon::now()->toDateString();
        $nombreMesActual = Carbon::now()->locale('es')->monthName;
        $fechaInicio = Carbon::now()->subDays(6)->startOfDay(); // Obtener fecha de inicio hace 7 días
        $fechaFin = Carbon::now()->endOfDay(); // Fin del día actual
        $fechaInicio_m = Carbon::now()->subMonths(11)->startOfMonth(); // Obtener fecha de inicio hace 12 meses
        $fechaFin_m = Carbon::now()->endOfMonth(); // Fin del mes actual
        $ingresosHoy = Pos::whereDate('fecha', $fechaHoy)->whereYear('fecha', $añoActual);
        $ingresosmesActual = Pos::whereMonth('fecha', $mesActual)->whereYear('fecha', $añoActual);
        $comprasamesActual = Compra::whereMonth('fecha', $mesActual)->whereYear('fecha', $añoActual);
        $clientes = Cliente::get();
        $pagosUltimasemana = Pos::select(DB::raw('DATE(fecha) as fecha'), DB::raw('SUM(total) as total'))
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->groupBy(DB::raw('DATE(fecha)'))
            ->orderBy('fecha', 'asc')
            ->get();
        $comprasUltimasemana = Compra::select(DB::raw('DATE(fecha) as fecha'), DB::raw('SUM(total) as total'))
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->groupBy(DB::raw('DATE(fecha)'))
            ->orderBy('fecha', 'asc')
            ->get();

        $fechaInicio_x = Carbon::now()->subDays(29)->startOfDay();
        $fechaFin_x = Carbon::now()->endOfDay();

        // Obtener pagos de los últimos 30 días incluyendo hoy
        $pagosUltimomes = Pos::select(DB::raw('DATE(fecha) as fecha'), DB::raw('SUM(total) as total'))
            ->whereBetween('fecha', [$fechaInicio_x, $fechaFin_x])
            ->groupBy(DB::raw('DATE(fecha)'))
            ->orderBy('fecha', 'asc')
            ->get();

        // Obtener compras de los últimos 30 días incluyendo hoy
        $comprasUltimomes = Compra::select(DB::raw('DATE(fecha) as fecha'), DB::raw('SUM(total) as total'))
            ->whereBetween('fecha', [$fechaInicio_x, $fechaFin_x])
            ->groupBy(DB::raw('DATE(fecha)'))
            ->orderBy('fecha', 'asc')
            ->get();

        $pagosUltimosDoceMeses = Pos::select(DB::raw('YEAR(fecha) as year'), DB::raw('MONTH(fecha) as month'), DB::raw('SUM(total) as total'))
            ->whereBetween('fecha', [$fechaInicio_m, $fechaFin_m])
            ->groupBy(DB::raw('YEAR(fecha)'), DB::raw('MONTH(fecha)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $comprasUltimosDoceMeses = Compra::select(DB::raw('YEAR(fecha) as year'), DB::raw('MONTH(fecha) as month'), DB::raw('SUM(total) as total'))
            ->whereBetween('fecha', [$fechaInicio_m, $fechaFin_m])
            ->groupBy(DB::raw('YEAR(fecha)'), DB::raw('MONTH(fecha)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();



        //RENTABILIDAD
//$rentabilidadHoy=Pos::where()->get();

        $productosVendidos = DB::table('detalle_venta')
            ->join('producto', 'detalle_venta.producto_id', '=', 'producto.id')
            ->join('medida', 'producto.medida_id', '=', 'medida.id')
            ->select(
                'producto.id',
                'producto.nombre',
                'medida.simbolo_sunat as simbolo_sunat',
                DB::raw('SUM(detalle_venta.cantidad) as total_cantidad'),
                DB::raw('SUM(detalle_venta.cantidad * detalle_venta.precio) as total_monto')
            )
            ->groupBy('producto.id', 'producto.nombre', 'medida.simbolo_sunat')
            ->orderBy('total_cantidad', 'desc')
            ->orderBy('total_monto', 'desc')
            ->limit(5)
            ->get();

        $topClientes = DB::table('venta')
            ->join('cliente', 'venta.cliente_id', '=', 'cliente.id')
            ->select(
                'cliente.id',
                'cliente.nombres',
                'cliente.apellidos',
                DB::raw('COUNT(*) as total_compras'),
                DB::raw('SUM(venta.total) as monto_total')
            )
            ->groupBy('cliente.id', 'cliente.nombres', 'cliente.apellidos')
            ->orderBy('monto_total', 'desc')
            ->limit(5)
            ->get();
        $productos = Producto::all();


        $empresa = Empresa::first(); // Obtener la primera empresa

        return view('dashboard', compact(
            'ingresosHoy',
            'ingresosmesActual',
            'nombreMesActual',
            'clientes',
            'pagosUltimasemana',
            'pagosUltimosDoceMeses',
            'productosVendidos',
            'topClientes',
            'productos',
            'comprasamesActual',
            'empresa',
            'comprasUltimasemana',
            'comprasUltimosDoceMeses',
            'pagosUltimomes',
            'comprasUltimomes'
        ));

        // Obtén el mes y el año actuales
        /*$mesActual = Carbon::now()->month;
        $añoActual = Carbon::now()->year;
        $fechaHoy = Carbon::now()->toDateString();
        $nombreMesActual =Carbon::now()->locale('es')->monthName;
       
        $instalacionmesactual = Instalacion::with(['cliente', 'plan', 'zona'])->whereMonth('fecha_instalacion', $mesActual)
            ->whereYear('fecha_instalacion', $añoActual)->get();
        $instalacionestotal = Instalacion::with(['cliente', 'plan', 'zona'])->get();
        $suspendidos = Instalacion::where('estado', 0)->get();
        $suspendidosMesActual = Suspendido::whereMonth('fecha_suspendido', $mesActual)->whereYear('fecha_suspendido', $añoActual)->get();

        $ingresosmesActual = Pago::whereMonth('fecha_pago', $mesActual)->whereYear('fecha_pago', $añoActual);
        $ingresosTotal = Pago::get();
        $ingresosHoy = Pago::whereDate('fecha_pago', $fechaHoy)->whereYear('fecha_pago', $añoActual);
        $pendientesmesActual = PagoPendiente::where('estado', 0)
            ->whereDate('fecha_emision', $mesActual)
            ->whereYear('fecha_emision', $añoActual);
        $pagosUltimasemana = Pago::select(DB::raw('DATE(fecha_pago) as fecha'), DB::raw('SUM(monto_total) as total'))
            ->whereBetween('fecha_pago', [$fechaInicio, $fechaFin])
            ->groupBy(DB::raw('DATE(fecha_pago)'))
            ->orderBy('fecha_pago', 'asc')
            ->get();

        $fechaInicio_m = Carbon::now()->subMonths(11)->startOfMonth(); // Obtener fecha de inicio hace 12 meses
        $fechaFin_m = Carbon::now()->endOfMonth(); // Fin del mes actual
        $pagosUltimosDoceMeses = Pago::select(DB::raw('YEAR(fecha_pago) as year'), DB::raw('MONTH(fecha_pago) as month'), DB::raw('SUM(monto_total) as total'))
            ->whereBetween('fecha_pago', [$fechaInicio_m, $fechaFin_m])
            ->groupBy(DB::raw('YEAR(fecha_pago)'), DB::raw('MONTH(fecha_pago)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();*/
        /*return view('dashboard', compact(
            'instalacionestotal',
            'instalacionmesactual',
            'ingresosmesActual',
            'ingresosHoy',
            'suspendidos',
            'suspendidosMesActual',
            'ingresosTotal',
            'pendientesmesActual',
            'pagosUltimasemana',
            'pagosUltimosDoceMeses',
            'nombreMesActual'
        ));*/
    }
}
