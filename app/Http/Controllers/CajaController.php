<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Categoria;
use App\Models\Compra;
use App\Models\IngEgr;
use App\Models\Medida;
use App\Models\Pos;
use App\Models\Producto;
use App\Models\Proveedor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
    //
    public function listarCaja()
    {
        $fechaInicio = Carbon::createFromFormat('Y-m-d', '2024-07-20');
        $cajas = Caja::where('usuario_id', Auth::user()->id)
        ->whereDate('fecha_apertura', '>=', $fechaInicio)
        ->get();

        return view('caja.listar', compact('cajas'));
    }
    public function showCaja(Request $request)
    {

        $hoy = Carbon::today();

        $caja = Caja::where('estado', 'abierto')
            ->where('usuario_id', Auth::user()->id)
            ->first();



        if ($caja) {
            $ingresos = Pos::where('caja_id', $caja->id)
                ->where('usuario_id', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->get();

            $egresos = IngEgr::where('caja_id', $caja->id)
                ->where('user_id', Auth::user()->id)
                ->where('tipo', 0)
                ->orderBy('id', 'desc')
                ->get();

            $ingresos_ex = IngEgr::where('caja_id', $caja->id)
                ->where('user_id', Auth::user()->id)
                ->where('tipo', 1)
                ->orderBy('id', 'desc')
                ->get();

            $egresos_x_compra = Compra::where('caja_id', $caja->id)
                ->where('usuario_id', Auth::user()->id)
                ->get();

            $cajas = Caja::where('estado', 'abierto')
                ->where('usuario_id', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            // Si no hay caja abierta, establecemos la variable para mostrar el modal

            $ingresos = collect(); // Devolvemos una colección vacía
            $egresos = collect();
            $ingresos_ex = collect();
            $egresos_x_compra = collect();
            $cajas = collect();
        }

        return view('caja.arqueo', compact('ingresos', 'egresos', 'ingresos_ex', 'cajas', 'egresos_x_compra', 'caja'));
    }
    public function addIngEgr(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'monto' => 'required',
                'descripcion' => 'required',
            ],
            [
                'monto.required' => 'El campo Monto es obligatorio',
                'descripcion.required' => 'El campo descripcion es obligatorio',
            ]
        );

        // Si la validación falla, devolver errores con código 422
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cajas = Caja::where('estado', 'abierto')
            ->where('usuario_id', Auth::user()->id)
            ->first();

        $procesarPago = IngEgr::create([
            'monto' => $request->input('monto'),
            'descripcion' =>  $request->input('descripcion'),
            'fecha' => now(),
            'tipo' =>  $request->input('tipo'),
            'tipo_pago' =>  $request->input('tipo_pago'),
            'tipo_doc' =>  $request->input('tipo_comprobante'),
            'user_id' =>  Auth::user()->id,
            'caja_id' =>  $cajas->id,
        ]);
        $ingresos = Pos::where('caja_id', $cajas->id)
            ->where('usuario_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        $egresos = IngEgr::where('caja_id', $cajas->id)
            ->where('user_id', Auth::user()->id)->where('tipo', 0)
            ->orderBy('id', 'desc')->get();

        $ingresos_ex = IngEgr::where('caja_id', $cajas->id)
            ->where('user_id', Auth::user()->id)->where('tipo', 1)
            ->orderBy('id', 'desc')->get();
            $egresos_x_compra =  Compra::where('caja_id', $cajas->id)
            ->where('usuario_id', Auth::user()->id)
            ->get();

        $cajas =   Caja::where('estado', 'abierto')->where('usuario_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();
       

        return view('caja.table', compact('ingresos', 'egresos', 'ingresos_ex', 'cajas', 'egresos_x_compra'));
    }

    public function addCerrarCaja(Request $request)
    {
        $hoy = Carbon::today();
        $validator = Validator::make(
            $request->all(),
            [
                'ingresos' => 'required',
                'egresos' => 'required',
                'saldo' => 'required',
            ],
            [
                'ingresos.required' => 'El campo Ingresos es obligatorio',
                'egresos.required' => 'El campo Egresos es obligatorio',
                'saldo.required' => 'El campo Saldo es obligatorio',
            ]
        );

        // Si la validación falla, devolver errores con código 422
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cajaExistente = Caja::where('estado', 'abierto')->where('usuario_id', Auth::user()->id)->first();
        if ($cajaExistente) {

            $cajaExistente->fecha_arqueo = now();
            $cajaExistente->saldo_inicial =  0;
            $cajaExistente->total_ingresos = $request->input('ingresos');
            $cajaExistente->total_egresos =  $request->input('egresos');
            $cajaExistente->saldo_final =  $request->input('saldo');
            $cajaExistente->estado =  'cerrado';
            $cajaExistente->observaciones =  $request->input('obs');
            $cajaExistente->save();
        }




        $ingresos = Pos::where('caja_id', $cajaExistente->id)
            ->where('usuario_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        $egresos = IngEgr::where('caja_id', $cajaExistente->id)
            ->where('user_id', Auth::user()->id)->where('tipo', 0)
            ->orderBy('id', 'desc')->get();

        $ingresos_ex = IngEgr::where('caja_id', $cajaExistente->id)
            ->where('user_id', Auth::user()->id)->where('tipo', 1)
            ->orderBy('id', 'desc')->get();


        $cajas =   Caja::where('estado', 'abierto')->where('usuario_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();
        $egresos_x_compra =  Compra::where('caja_id', $cajaExistente->id)
            ->where('usuario_id', Auth::user()->id)
            ->get();
        return view('caja.table', compact('ingresos', 'egresos', 'ingresos_ex', 'cajas', 'egresos_x_compra'));
    }
    public function abrirCaja(Request $request)
    {
        $validatedData = $request->validate([
            'saldo_inicial' => 'required|numeric|min:0',
        ]);

        try {
            $caja = Caja::create([
                'fecha_apertura' => now(),
                'saldo_inicial' => $validatedData['saldo_inicial'],
                'estado' => 'abierto',
                'usuario_id' => Auth::user()->id,
                // Otros campos según sea necesario
            ]);

            return redirect()->back()->with('message', 'Caja abierta con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al abrir la caja'])->withInput();
        }
    }
}
