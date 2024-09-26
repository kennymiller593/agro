<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Detalle;
use App\Models\Empresa;
use App\Models\Medida;
use App\Models\Pos;
use App\Models\Producto;
use App\Models\Proveedor;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\View;
use Luecano\NumeroALetras\NumeroALetras;

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Despatch\Despatch;
use Greenter\Model\Despatch\Driver;
use Greenter\Model\Despatch\Shipment;
use Greenter\Model\Despatch\Transportist;
use Greenter\Model\Despatch\Vehicle;
use Greenter\Model\Sale\FormaPagos\FormaPagoContado;
use Greenter\Model\Sale\Invoice;
use Greenter\See;
use Greenter\Ws\Services\SunatEndpoints;
use Greenter\Model\Company\Company;
use Greenter\Model\Despatch\DespatchDetail;
use Greenter\Model\Despatch\Direction;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\Note;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Report\HtmlReport;
use Greenter\Report\PdfReport;
use Greenter\Report\Resolver\DefaultTemplateResolver;


class posController extends Controller
{
    //
    public function generateInvoice($venta)
    {
        // Configuración del cliente
        $client = new Client();
        $client->setTipoDoc('6') // RUC
            ->setNumDoc('20608731653')
            ->setRznSocial('EMPRESA SAC');

        // Detalle de la venta
        $items = [];
        foreach ($venta->detallesventa as $detalle) {
            $item = new SaleDetail();
            $item->setCodProducto($detalle->productos->codigo)
                ->setUnidad('NIU')
                ->setDescripcion($detalle->productos->nombre)
                ->setCantidad($detalle->cantidad)
                ->setMtoValorUnitario($detalle->precio)
                ->setMtoValorVenta($detalle->precio * $detalle->cantidad)
                ->setMtoBaseIgv($detalle->precio * $detalle->cantidad)
                ->setPorcentajeIgv(18.00)
                ->setIgv($detalle->precio * $detalle->cantidad * 0.18)
                ->setTipAfeIgv('10');
            $items[] = $item;
        }

        //LEGENT
        $legend = new Legend();
        $legend->setCode('1000')
            ->setValue('SON CIENTO DIECIOCHO CON 00/100 SOLES');
        //COMPANY
        $addres = new Address();
        $addres->setUbigueo('10001')
            ->setDepartamento('Huanuco')
            ->setProvincia('Huanuco')
            ->setDistrito('Huanuco')
            ->setUrbanizacion('Portales')
            ->setDireccion('Calle las flores')
            ->setCodLocal('002');
        $company = new Company();
        $company->setRuc('20608731653')
            ->setRazonSocial('INKANET')
            ->setNombreComercial('SERVICIO GENERALES')
            ->setAddress($addres);
        // Crear el comprobante
        $invoice = new Invoice();
        $invoice->setTipoDoc('01') // Factura
            ->setSerie('F002')
            ->setCorrelativo($venta->num_comprobante)
            ->setFechaEmision(new \DateTime())
            ->setTipoMoneda('PEN')
            ->setClient($client)
            ->setMtoOperGravadas($venta->total)
            ->setMtoIGV($venta->total * 0.18)
            ->setTotalImpuestos($venta->total * 0.18)
            ->setValorVenta($venta->total)
            ->setMtoImpVenta($venta->total + ($venta->total * 0.18))
            ->setCompany($company)
            ->setDetails($items)
            ->setLegends([$legend]);

        // Enviar a SUNAT
        $cert_path = public_path('certs/LLAMAPECERTIFICADODEMO20608731653_cert_out.pem');
        $contenido = file_get_contents($cert_path);
        $see = new See();
        $see->setService(SunatEndpoints::FE_BETA); // Cambiar a FE_PRODUCCION para ambiente de producción
        $see->setCertificate($contenido);
        $see->setClaveSOL('20608731653', 'prueba', 'prueba');

        $result = $see->send($invoice);

        if (!$result->isSuccess()) {
            throw new \Exception('Error al enviar el comprobante: ' . $result->getError()->getMessage());
        }

        // Guardar XML y CDR
        file_put_contents('certs/' . $invoice->getName() . '.xml', $see->getXmlSigned($invoice));
        file_put_contents('certs/' . $invoice->getName() . '.cdr', $result->getCdrZip());

        // Generar PDF
        $htmlReport = new HtmlReport();
        $resolver = new DefaultTemplateResolver();
        $htmlReport->setTemplate($resolver->getTemplate($invoice));
        $report = new PdfReport($htmlReport);
        $report->setOptions([
            'no-outline',
            'viewport-size' => '1280x1024',
            'page-width' => '21cm',
            'page-height' => '29.7cm',
        ]);

        $report->setBinPath(env('WKHTMLTOPDF_PATH'));

        try {
            $params = [
                'system' => [
                    'logo' => file_get_contents('empresa/1724865310.png'), // Asegúrate de que la ruta del logo sea correcta
                    'hash' => 'qqnr2dN4p/HmaEA/CJuVGo7dv5g=', // Valor Resumen 
                ],
                'user' => [
                    'header'     => 'Telf: <b>(01) 123375</b>', // Texto que se ubica debajo de la dirección de empresa
                    'extras'     => [
                        // Leyendas adicionales
                        ['name' => 'CONDICION DE PAGO', 'value' => 'Transferencia'],
                        ['name' => 'VENDEDOR', 'value' => 'Admin Inkanet'],
                    ],
                    'footer' => '<p>Nro Resolucion: <b>3232323</b></p>'
                ]
            ];

            $pdf = $report->render($invoice, $params);
            file_put_contents('certs/' . $invoice->getName() . '.pdf', $pdf);

            return 'certs/' . $invoice->getName() . '.pdf';
        } catch (\Exception $e) {
            // Manejar errores
            return 'Error al generar el PDF: ' . $e->getMessage();
        }
    }
    public function show()
    {
        $productos = Producto::where('estado', 1)->orderBy('nombre', 'asc')->get();
        $clientes = Cliente::all();
        $cart = session()->get('cart', []);
        $cajaAbierta = Caja::where('estado', 'abierto')
            ->where('usuario_id', Auth::user()->id)
            ->first();


        return view('pos.vender', compact('productos', 'cart', 'clientes', 'cajaAbierta'));
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
                "price" => $product->precio_venta,
                "uni_medida" => $product->unimedida->simbolo_sunat,
                "id" => $product->id,
            ];
        }

        session()->put('cart', $cart);
        return view('pos.partial', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity && $request->price) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            $cart[$request->id]["price"] = $request->price;
            session()->put('cart', $cart);

            // Recalcular el total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            return view('pos.partial', compact('cart'));
        }
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
        $total = 0;
        $gananciaTotal = 0;


        $caja = Caja::where('estado', 'abierto')
            ->where('usuario_id', Auth::user()->id)
            ->first();

        // Iniciamos una transacción de base de datos
        DB::beginTransaction();

        try {
            $venta = Pos::create([
                'tipo_comprobante' => $request->tipo_comprobante,
                'serie_comprobante' => '001',
                'num_comprobante' => '1000',
                'fecha' => now(),
                'igv' => 0,
                'total' => 0, // Lo actualizaremos después
                'estado' => 1,
                'usuario_id' => Auth::user()->id,
                'cliente_id' => $request->client_id,
                'forma_pago' => $request->forma_pago,
                'tipo_pago' => $request->tipo_pago,
                'caja_id' => $caja->id
            ]);

            foreach ($cart as $item) {
                $producto = Producto::findOrFail($item['id']);
                $cantidadVendida = $item['quantity'];
                $precioVenta = $item['price'];
                $subtotal = $precioVenta * $cantidadVendida;
                $costoVenta = 0;

                // Calcular el costo de venta usando FIFO
                $detallesCompra = $producto->detalleCompras()
                    ->where('cantidad_restante', '>', 0)
                    ->orderBy('id', 'asc')
                    ->get();

                foreach ($detallesCompra as $detalleCompra) {
                    if ($cantidadVendida <= 0) break;

                    $cantidadUsada = min($cantidadVendida, $detalleCompra->cantidad_restante);
                    $costoVenta += $cantidadUsada * $detalleCompra->precio_compra;
                    $cantidadVendida -= $cantidadUsada;

                    $detalleCompra->decrement('cantidad_restante', $cantidadUsada);
                }

                $ganancia = $subtotal - $costoVenta;
                $gananciaTotal += $ganancia;

                Detalle::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $item['id'],
                    'cantidad' => $item['quantity'],
                    'precio' => $precioVenta,
                    'descuento' => 0,
                    'costo_venta' => $costoVenta,
                    'ganancia' => $ganancia,
                ]);

                $producto->decrement('stok', $item['quantity']);

                $total += $subtotal;
            }

            // Actualizamos el total y la ganancia de la venta
            $venta->update([
                'total' => $total,
                'ganancia_total' => $gananciaTotal,
            ]);

            // Confirmamos la transacción
            DB::commit();

            // Limpiamos el carrito después de procesar el pago
            session()->forget('cart');
            // $pdfUrl = $this->generateInvoice($venta);
            /* return response()->json([
                'success' => true,
                'message' => 'Pago procesado correctamente',
                'total' => $total,
                'ganancia' => $gananciaTotal,
                'pdfUrl' => $pdfUrl,
                'success_id' => $venta->id,
            ]);*/
            return response()->json([
                'success' => true,
                'message' => 'Pago procesado correctamente',
                'total' => $total,
                'ganancia' => $gananciaTotal,
                'pdfUrl' => route('generate.pdf', $venta->id),
                'success_id' => $venta->id,
            ]);
        } catch (\Exception $e) {
            // Si algo sale mal, revertimos la transacción
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el pago: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function generatePDF($successId)
    {


        $success = Pos::where('id', '=', $successId)->get();
        foreach ($success as $pay) {
            $total = $pay->total;
        }
        $empresa = Empresa::first();
        $formatter = new NumeroALetras();
        $totalInWords = $formatter->toMoney($total, 2, 'SOLES', 'CENTAVOS');

        $pdf = FacadePdf::loadView('pos.invoice', compact('success', 'successId', 'totalInWords', 'empresa'));

        $pdf->setPaper([0, 0, 226.77, 841.89], 'portrait');

        // $pdf->setPaper([-20, 0, 500, 1000], 'portrait');
        // Cambia `download` por `stream`
        return $pdf->stream($successId . '.pdf');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $productos = Producto::where('nombre', 'LIKE', "%{$query}%")->where('estado', 1)->orderBy('nombre', 'asc')->get();
        return view('pos.partial-prod', compact('productos'))->render();
    }
}
