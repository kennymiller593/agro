<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Instalacion;
use App\Models\Pago;
use App\Models\PagoPendiente;
use App\Services\SunatService;
use App\Traits\SunatTrait;
use Greenter\Report\XmlUtils;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PagosPendientesController extends Controller
{
    //
    use SunatTrait;

    public function procesarPago(Request $request)
    {
        $pendienteId = $request->input('pendiente_id');
        $cliente = $request->input('txt_data_cliente');
        $fechaPago = $request->input('txt_fecha_pago');
        $fechaVencimiento = $request->input('txt_fecha_vencimiento');
        $formaPago = $request->input('forma_pago');
        $accion = $request->input('action');
        $monto = $request->input('monto');
        $instalacion_id = $request->input('instalacion_id');
        $tipo_doc = $request->input('tipo_doc');




        // Realizar las operaciones necesarias con los datos recibidos
        $procesarPago = Pago::create([
            'fecha_pago' => $fechaPago,
            'monto_total' => $monto,
            'medio_pago' => $formaPago,
            'instalacion_id' => $instalacion_id,
            'pendiente_id' => $pendienteId
        ]);
        $pendiente = PagoPendiente::find($request->input('pendiente_id'));
        $pendiente->estado = 1;
        $pendiente->total = 0;
        $pendiente->save();
        if ($accion == 1) {
            $activarInstalacion = Instalacion::find($request->input('instalacion_id'));
            $activarInstalacion->estado = 1;
            $activarInstalacion->save();
        }

        

        // $sunat->generatePdfReport($invoice);
      
        // Devolver una respuesta, por ejemplo, un JSON indicando el éxito del procesamiento
        return response()->json(['message' => 'Pago procesado correctamente:']);
    }

    public function show(Request $request)
    {

        /*$pendientes = PagoPendiente::all();
        return view('clientes.pagos-pendientes', compact('pendientes'));*/
        if ($request->ajax()) {

            $pendientes = PagoPendiente::with(['instalacion', 'instalacion.cliente', 'instalacion.plan'])->where('estado', '=', 0)->get();
            return response()->json(['data' => $pendientes]);
        }
        return view('clientes.pagos-pendientes');
    }
    public function generarPendiente(Request $request)
    {

        $cliente = $request->input('txt_data_cliente');
        $fechaPago = $request->input('txt_fecha_pago');
        $fechaVencimiento = $request->input('txt_fecha_vencimiento');
        $descripcion = $request->input('descripcion');
        $cantidad = $request->input('cantidad');
        $precio = $request->input('monto_ind');
        $total = $request->input('monto');
        $instalacion_id = $request->input('instalacion_id');

        // Realizar las operaciones necesarias con los datos recibidos
        $procesarPendiente = PagoPendiente::create([
            'instalacion_id' => $instalacion_id,
            'fecha_emision' => $fechaPago,
            'fecha_vencimiento' => $fechaVencimiento,
            'descripcion' => $descripcion,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'total' => $total,
            'estado' => 0
        ]);


        // Devolver una respuesta, por ejemplo, un JSON indicando el éxito del procesamiento
        return response()->json(['message' => 'Pago procesado correctamente']);
    }
}
