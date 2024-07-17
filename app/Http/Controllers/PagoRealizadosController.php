<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoRealizadosController extends Controller
{
    //
    public function pagoRealizados(Request $request)
    {
       // $realizados = Pago::with(['instalacion'])->get();
        if ($request->ajax()) {

            $realizados = Pago::with(['instalacion', 'instalacion.cliente', 'instalacion.plan'])->get();
            return response()->json(['data' => $realizados]);
        }
        return view('clientes.pagos-realizados');
     //   return view('clientes.pagos-realizados',compact('realizados'));
    }
}
