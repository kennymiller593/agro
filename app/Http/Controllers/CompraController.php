<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    //
    public function listarCompra(Request $request)
    {
        if ($request->ajax()) {
            $compra = Compra::with(['proveedor'])->orderBy('id', 'desc')->get();
            // Devuelve los datos en formato JSON que DataTables espera
            return response()->json([
                'data' => $compra
            ]);
        } else {
            return view('compra.lista');
        }
    }
    public function detalleCompra($id)
    {
        $historial = DetalleCompra::where('compra_id', $id)->get();
        // $historial = $producto->historialCompras;
        return view('compra.detalle-compra', compact('historial'))->render();
        // return response()->json($historial);
    }
}
