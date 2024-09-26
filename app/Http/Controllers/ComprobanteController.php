<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Medida;
use App\Models\Pos;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprobanteController extends Controller
{
    //
    public function showComprobante(Request $request)
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

        if ($request->ajax()) {

            $pos = Pos::with(['cliente'])->orderBy('id', 'desc')->get();
            return response()->json(['data' => $pos]);
        } else {
            $categorias = Categoria::orderBy('id', 'desc')->get();
            $proveedores = Proveedor::orderBy('id', 'desc')->get();
            $medidas = Medida::orderBy('id', 'desc')->get();
        }
        return view('pos.comprobante', compact('categorias', 'proveedores', 'medidas', 'startDate', 'endDate'));
    }
    public function destroy(Request $request)
    {
        try {
            // Buscar la venta por su ID
            $comprobante = Pos::findOrFail($request->comprobante_id);
            // Iniciamos una transacción de base de datos
            DB::beginTransaction();
            foreach ($comprobante->detallesventa as $detalle) {
                // Obtener el producto asociado al detalle
                $producto = $detalle->productos;
                // La cantidad que necesitamos devolver al inventario
                $cantidadRestaurar = $detalle->cantidad;
                // Obtener las entradas de inventario (detalleCompras) en el orden FIFO inverso
                $detallesCompra = $producto->detalleCompras()
                    ->orderBy('id', 'desc') // Orden inverso para restaurar FIFO
                    ->get();
                foreach ($detallesCompra as $detalleCompra) {
                    if ($cantidadRestaurar <= 0) break;
                    $cantidadDisponibleParaRestaurar = $detalleCompra->cantidad - $detalleCompra->cantidad_restante;
                    if ($cantidadDisponibleParaRestaurar > 0) {
                        $cantidadADevolver = min($cantidadRestaurar, $cantidadDisponibleParaRestaurar);
                        // Incrementa la cantidad restante de la compra original
                        $detalleCompra->increment('cantidad_restante', $cantidadADevolver);
                        // Decrementa la cantidad que aún necesitamos restaurar
                        $cantidadRestaurar -= $cantidadADevolver;
                    }
                }
                // Incrementar el stock del producto
                $producto->increment('stok', $detalle->cantidad);
                // Guardar cambios en el producto
                $producto->save();
            }
            // Elimina los detalles asociados a la venta
            $comprobante->detallesventa()->delete();
            // Elimina la venta (comprobante)
            $comprobante->delete();
            // Confirmamos la transacción
            DB::commit();
            return response()->json([
                'message' => 'Comprobante eliminado exitosamente y el stock ha sido restaurado.'
            ]);
        } catch (\Exception $e) {
            // Si algo sale mal, revertimos la transacción
            DB::rollBack();
            return response()->json([
                'errors' => 'Error: ' . $e->getMessage()
            ], 422);
        }
    }
}
