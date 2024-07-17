<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Services\SunatService;
use App\Traits\SunatTrait;
use Luecano\NumeroALetras\NumeroALetras;
use Greenter\Report\XmlUtils;
use Greenter\See;
use Greenter\Ws\Services\SunatEndpoints;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    use SunatTrait;
    public  function send(Request $request)
    {
        $empresa = Empresa::where('ruc', '20608731653')->first();
        $data = $request->all();
        $request->validate([
            'company' => 'required|array',
            'company.address' => 'required|array',
            'client' => 'required|array',
            'details' => 'required|array',
            'details.*' => 'required|array',
        ]);
        /*$data = [
            "ublVersion" => "2.1",
            "tipoDoc" => "01",
            "tipoOperacion" => "0101",
            "serie" => "F002",
            "correlativo" => "1",
            "fechaEmision" => "2024-02-25T00:00:00-05:00",
            "tipoMoneda" => "PEN",
            "company" => [
                "ruc" => 20609278235,
                "razonSocial" => "Coders Free S.A.C",
                "nombreComercial" => "Coders Free",
                "address" => [
                    "ubigueo" => "150101",
                    "departamento" => "LIMA",
                    "provincia" => "LIMA",
                    "distrito" => "LIMA",
                    "urbanizacion" => "-",
                    "direccion" => "Av. Villa Nueva 221",
                    "codLocal" => "0000"
                ]
            ],
            "client" => [
                "tipoDoc" => "6",
                "numDoc" => 20000000001,
                "rznSocial" => "EMPRESA X"
            ],
            "mtoOperGravadas" => 100, //eliminar
            "mtoIGV" => 18.00, //eliminar
            "totalImpuestos" => 18.00, //eliminar
            "valorVenta" => 100.00, //eliminar
            "subTotal" => 118.00, //eliminar
            "mtoImpVenta" => 118.00, //eliminar

            "details" => [
                [
                    "tipAfeIgv" => 10,
                    "codProducto" => "P001",
                    "unidad" => "NIU",
                    "descripcion" => "PRODUCTO 1",
                    "cantidad" => 2,
                    "mtoValorUnitario" => 50,
                    "mtoValorVenta" => 100,
                    "mtoBaseIgv" => 100,
                    "porcentajeIgv" => 18,
                    "igv" => 18,
                    "totalImpuestos" => 18,
                    "mtoPrecioUnitario" => 59
                ]
            ],
            "legends" => [
                [
                    "code" => "1000",
                    "value" => "SON DOSCIENTOS TREINTA Y SEIS CON 00/100 SOLES"
                ]
            ]
        ];*/



        $this->setTotales($data);
        $this->setLegends($data);

        $sunat = new SunatService();

        $see = $sunat->getSee($empresa);
        $invoice = $sunat->getInvoice($data);

        $result = $see->send($invoice);
        $response['xml'] = $see->getFactory()->getLastXml();
        $response['hash'] = (new XmlUtils())->getHashSign($response['xml']);
        $response['sunatResponse'] = $sunat->sunatResponse($result);

        return response()->json($response);
        // return $data;
    }
    public function xml(Request $request)
    {
        $empresa = Empresa::where('ruc', '20608731653')->first();
        $data = $request->all();
        $request->validate([
            'company' => 'required|array',
            'company.address' => 'required|array',
            'client' => 'required|array',
            'details' => 'required|array',
            'details.*' => 'required|array',
        ]);
        $this->setTotales($data);
        $this->setLegends($data);
        $sunat = new SunatService();
        $see = $sunat->getSee($empresa);
        $invoice = $sunat->getInvoice($data);

        $response['xml'] = $see->getXmlSigned($invoice);
        $response['hash'] = (new XmlUtils())->getHashSign($response['xml']);
        return response()->json($response, 200);
    }
    public function pdf(Request $request)
    {
        $empresa = Empresa::where('ruc', '20608731653')->first();
        $data = $request->all();
        $request->validate([
            'company' => 'required|array',
            'company.address' => 'required|array',
            'client' => 'required|array',
            'details' => 'required|array',
            'details.*' => 'required|array',
        ]);
        $this->setTotales($data);
        $this->setLegends($data);
        $sunat = new SunatService();

        $invoice = $sunat->getInvoice($data);
        $sunat->generatePdfReport($invoice);
        return $sunat->getHtmlReport($invoice);
    }
    
}
