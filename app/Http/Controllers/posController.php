<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Detalle;
use App\Models\Medida;
use App\Models\Pos;
use App\Models\Producto;
use App\Models\Proveedor;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\View;
use Luecano\NumeroALetras\NumeroALetras;

class posController extends Controller
{
    //
    public function show()
    {
        $productos = Producto::orderBy('id', 'desc')->get();
        $clientes = Cliente::all();
        $cart = session()->get('cart', []);
        return view('pos.vender', compact('productos', 'cart', 'clientes'));
    }
    public function showComprobante(Request $request)
    {
        if ($request->ajax()) {

            $pos = Pos::with(['cliente'])->orderBy('id', 'desc')->get();
            return response()->json(['data' => $pos]);
        } else {
            $categorias = Categoria::orderBy('id', 'desc')->get();
            $proveedores = Proveedor::orderBy('id', 'desc')->get();
            $medidas = Medida::orderBy('id', 'desc')->get();
        }
        return view('pos.comprobante', compact('categorias', 'proveedores', 'medidas'));
    }
    public function addToCart(Request $request, Producto $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->nombre,
                "quantity" => 1,
                "price" => $request->input('Idp'),
                "uni_medida" => $product->unimedida->simbolo_sunat,
                "id" => $product->id,
            ];
        }

        session()->put('cart', $cart);
        return view('pos.partial', compact('cart'));
    }
    public function removeFromCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return view('pos.partial', compact('cart'));
    }
    public function processPayment(Request $request)
    {
        $cart = session()->get('cart', []);

        // Aquí iría la lógica para procesar el pago
        // Por ejemplo, integración con una pasarela de pago

        // Por ahora, simplemente calcularemos el total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Aquí podrías guardar la orden en la base de datos


        $procesarPago = Pos::create([
            'tipo_comprobante' => 'B',
            'serie_comprobante' =>  '001',
            'num_comprobante' => '1000',
            'fecha' => now(),
            'igv' => 0,
            'total' => $total,
            'estado' => 1,
            'usuario_id' => 1,
            'cliente_id' =>  $request->client_id,
        ]);



        $total_partial = 0;
        foreach ($cart as $item) {
            $total_partial = $item['price'] * $item['quantity'];
            $procesarDetalle = Detalle::create([
                'venta_id' => $procesarPago->id,
                'producto_id' =>  $item['id'],
                'cantidad' => $item['quantity'],
                'precio' => $item['price'],
                'descuento' => 0,
            ]);



            // Encuentra el producto y actualiza el stock
            $producto = Producto::find($item['id']);
            if ($producto) {
                $producto->stok -= $item['quantity'];
                $producto->save();
            }
        }

        // Limpiamos el carrito después de procesar el pago
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Pago procesado correctamente',
            'total' => $total,
            'pdfUrl' => route('generate.pdf', $procesarPago->id),
            'success_id' => $procesarPago->id,
        ]);
    }

    public function generatePDF($successId)
    {


        $success = Pos::where('id', '=', $successId)->get();
        foreach ($success as $pay) {
            $total = $pay->total;
        }


        $formatter = new NumeroALetras();
        $totalInWords = $formatter->toMoney($total, 2, 'SOLES', 'CENTAVOS');

        $pdf = FacadePdf::loadView('pos.invoice', compact('success', 'successId', 'totalInWords'));
        $pdf->setPaper([0, 0, 226.77, 841.89], 'portrait');
        // Cambia `download` por `stream`
        return $pdf->stream($successId . '.pdf');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $productos = Producto::where('nombre', 'LIKE', "%{$query}%")->get();
        return view('pos.partial-prod', compact('productos'))->render();
    }
}
