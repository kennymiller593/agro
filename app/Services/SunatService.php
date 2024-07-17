<?php

namespace App\Services;

use App\Models\Empresa;
use DateTime;
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
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;

class SunatService
{
    public function getSee($empresa)
    {
        $cert_path = public_path('certs/' . $empresa->cert_path);
        $contenido = file_get_contents($cert_path);
        $see = new See();
        $see->setCertificate($contenido);
        $see->setService($empresa->production ? SunatEndpoints::FE_PRODUCCION : SunatEndpoints::FE_BETA);
        $see->setClaveSOL($empresa->ruc, $empresa->sol_user, $empresa->sol_pass);

        return $see;
    }
   
    public function getInvoice($data)
    {
        return (new Invoice())
            ->setUblVersion($data['ublVersion'] ?? '2.1')
            ->setTipoOperacion($data['tipoOperacion'] ?? null) // Venta - Catalog. 51
            ->setTipoDoc($data['tipoDoc'] ?? null) // Factura - Catalog. 01 
            ->setSerie($data['serie'] ?? null)
            ->setCorrelativo($data['correlativo'] ?? null)
            ->setFechaEmision(new DateTime($data['fechaEmision']) ?? null) // Zona horaria: Lima
            ->setFormaPago(new FormaPagoContado()) // FormaPago: Contado
            ->setTipoMoneda($data['tipoMoneda'] ?? null) // Sol - Catalog. 02
            ->setCompany($this->getCompany($data['company']))
            ->setClient($this->getClient($data['client']))

            //MtoOper
            ->setMtoOperGravadas($data['mtoOperGravadas'])
            ->setMtoOperExoneradas($data['mtoOperExoneradas'])
            ->setMtoOperInafectas($data['mtoOperInafectas'])
            ->setMtoOperExportacion($data['mtoOperExportacion'])
            ->setMtoOperGratuitas($data['mtoOperGratuitas'])


            //Impuestos
            ->setMtoIGV($data['mtoIGV'])
            ->setMtoIgvGratuitas($data['mtoIgvGratuitas'])
            ->setTotalImpuestos($data['totalImpuestos'])

            //Totales
            ->setTotalImpuestos($data['totalImpuestos'])
            ->setValorVenta($data['valorVenta'])
            ->setSubTotal($data['subTotal'])
            ->setRedondeo($data['Redondeo'])
            ->setMtoImpVenta($data['mtoImpVenta'])

            //Productos
            ->setDetails($this->getDetails($data['details']))

            //Leyendas
            ->setLegends($this->getLegends($data['legends']));
    }
    public function getSeeApi($company)
    {
        $cert_path = public_path('certs/' . $company->cert_path);
        $contenido = file_get_contents($cert_path);
        $api = new \Greenter\Api($company->production ?
            [
                'auth' => 'https://api-seguridad.sunat.gob.pe/v1',
                'cpe' => 'https://api-cpe.sunat.gob.pe/v1'
            ] :
            [
                'auth' => 'https://gre-test.nubefact.com/v1',
                'cpe' => 'https://gre-test.nubefact.com/v1'
            ]);
        $api->setBuilderOptions([
            'strict_variables' => true,
            'optimizations' => 0,
            'debug' => true,
            'cache' => false,
        ])->setApiCredentials(
            $company->production ? $company->client_id : "test-85e5b0ae-255c-4891-a595-0b98c65c9854",
            $company->production ? $company->client_secret : "test-Hty/M6QshYvPgItX2P0+Kw=="
        )->setClaveSOL(
            $company->ruc,
            $company->production  ? $company->sol_user : "MODDATOS",
            $company->production  ? $company->sol_pass : "MODDATOS"
        )->setCertificate(
            $contenido
        );
        return $api;
    }
    public function getNote($data)
    {
        return (new Note)
            ->setUblVersion($data['ublVersion'] ?? '2.1')
            ->setTipoDoc($data['tipoDoc'] ?? null) // Factura - Catalog. 01 
            ->setSerie($data['serie'] ?? null)
            ->setCorrelativo($data['correlativo'] ?? null)
            ->setFechaEmision(new DateTime($data['fechaEmision']) ?? null) // Zona horaria: Lima
            ->setTipDocAfectado($data['tipDocAfectado'] ?? null)
            ->setNumDocfectado($data['numDocfectado'] ?? null)
            ->setCodMotivo($data['codMotivo'] ?? null)
            ->setDesMotivo($data['desMotivo'] ?? null)
            ->setTipoMoneda($data['tipoMoneda'] ?? null) // Sol - Catalog. 02
            ->setCompany($this->getCompany($data['company']))
            ->setClient($this->getClient($data['client']))

            //MtoOper
            ->setMtoOperGravadas($data['mtoOperGravadas'])
            ->setMtoOperExoneradas($data['mtoOperExoneradas'])
            ->setMtoOperInafectas($data['mtoOperInafectas'])
            ->setMtoOperExportacion($data['mtoOperExportacion'])
            ->setMtoOperGratuitas($data['mtoOperGratuitas'])


            //Impuestos
            ->setMtoIGV($data['mtoIGV'])
            ->setMtoIgvGratuitas($data['mtoIgvGratuitas'])
            ->setTotalImpuestos($data['totalImpuestos'])

            //Totales
            ->setTotalImpuestos($data['totalImpuestos'])
            ->setValorVenta($data['valorVenta'])
            ->setSubTotal($data['subTotal'])
            ->setRedondeo($data['Redondeo'])
            ->setMtoImpVenta($data['mtoImpVenta'])

            //Productos
            ->setDetails($this->getDetails($data['details']))

            //Leyendas
            ->setLegends($this->getLegends($data['legends']));;
    }
    public function getDespatch($data)
    {
        return (new Despatch)
            ->setVersion($data['version'] ?? '2022')
            ->setTipoDoc($data['tipoDoc'] ?? '09')
            ->setTipoDoc($data['serie'] ?? null)
            ->setCorrelativo($data['correlativo'] ?? null)
            ->setFechaEmision(new DateTime($data['fechaEmision']) ?? null)
            ->setCompany($this->getCompany($data['company']))
            ->setDestinatario($this->getClient($data['destinatario']))
            ->setEnvio($this->getEnvio($data['envio']))
            ->setDetails($this->getDespatchDetails($data['details']));
    }
    public function getCompany($company)
    {
        return (new Company())
            ->setRuc($company['ruc'] ?? null)
            ->setRazonSocial($company['razonSocial'] ?? null)
            ->setNombreComercial($company['nombreComercial'] ?? null)
            ->setAddress($this->getAdress($company['address']));
    }
    public function getClient($client)
    {
        return (new Client())
            ->setTipoDoc($client['tipoDoc'] ?? null)
            ->setNumDoc($client['numDoc'] ?? null)
            ->setRznSocial($client['rznSocial'] ?? null);
    }
    public function getAdress($address)
    {
        return (new Address())
            ->setUbigueo($address['ubigueo'] ?? null)
            ->setDepartamento($address['departamento'] ?? null)
            ->setProvincia($address['provincia'] ?? null)
            ->setDistrito($address['distrito'] ?? null)
            ->setUrbanizacion($address['urbanizacion'] ?? null)
            ->setDireccion($address['direccion'] ?? null)
            ->setCodLocal($address['codLocal'] ?? null);
    }
    public function getDetails($details)
    {
        $green_details = [];
        foreach ($details as $detail) {
            $green_details[] =   (new SaleDetail())
                ->setTipAfeIgv($detail['tipAfeIgv'] ?? null) // Gravado Op. Onerosa - Catalog. 07
                ->setCodProducto($detail['codProducto'] ?? null)
                ->setUnidad($detail['unidad'] ?? null) // Unidad - Catalog. 03
                ->setCantidad($detail['cantidad'] ?? null)
                ->setMtoValorUnitario($detail['mtoValorUnitario'] ?? null)
                ->setDescripcion($detail['descripcion'] ?? null)
                ->setMtoBaseIgv($detail['mtoBaseIgv'] ?? null)
                ->setPorcentajeIgv($detail['porcentajeIgv'] ?? null) // 18%
                ->setIgv($detail['igv'] ?? null)
                ->setFactorIcbper($detail['factorIcbper'] ?? null)
                ->setIcbper($detail['icbper'] ?? null)
                ->setTotalImpuestos($detail['totalImpuestos'] ?? null) // Suma de impuestos en el detalle
                ->setMtoValorVenta($detail['mtoValorVenta'] ?? null)
                ->setMtoPrecioUnitario($detail['mtoPrecioUnitario'] ?? null);
        }
        return  $green_details;
    }
    public function getLegends($legends)
    {
        $green_legends = [];
        foreach ($legends as $legend) {
            $green_legends[] = (new Legend())
                ->setCode($legend['code'] ?? null) // Monto en letras - Catalog. 52
                ->setValue($legend['value'] ?? null);
        }
        return $green_legends;
    }
    public function getEnvio($data)
    {
        $shipment = (new Shipment)
            ->setCodTraslado($data['codTraslado'] ?? null)
            ->setModTraslado($data['modTraslado'] ?? null)
            ->setFecTraslado(new DateTime($data['fecTraslado']) ?? null)
            ->setPesoTotal($data['pesoTotal'] ?? null)
            ->setUndPesoTotal($data['undPesoTotal'] ?? null)
            ->setLlegada(new Direction($data['llegada']['ubigueo'], $data['llegada']['direccion']) ?? null)
            ->setPartida(new Direction($data['partida']['ubigueo'], $data['partida']['direccion']) ?? null);
        if ($data['modTraslado'] == "01") {
            $shipment->setTransportista($this->getTransportista($data['transportista']));
        }
        if ($data['modTraslado'] == "02") {
            $shipment->setVehiculo($this->getVehiculo($data['vehiculos']))
                ->setChoferes($this->getChoferes($data['choferes']));
        };
        return $shipment;
    }
    public function getVehiculo($vehiculos)
    {
        $vehiculos = collect($vehiculos);
        $secundarios = [];
        foreach ($vehiculos->slice(1) as $item) {
            $secundarios[] = (new Vehicle())
                ->setPlaca($item['placa'] ?? null);
        }
        return (new Vehicle())
            ->setPlaca($vehiculos->first()['placa'] ?? null)
            ->setSecundarios($secundarios);
    }
    public function getChoferes($choferes)
    {
        $choferes = collect($choferes);

        $drivers = [];
        $drivers[] = (new Driver)
            ->setTipo('Principal')
            ->setTipoDoc($choferes->first()['tipoDoc'] ?? null)
            ->setNroDoc($choferes->first()['nroDoc'] ?? null)
            ->setLicencia($choferes->first()['licencia'] ?? null)
            ->setNombres($choferes->first()['nombres'] ?? null)
            ->setApellidos($choferes->first()['apellidos'] ?? null);

        foreach ($choferes->slice(1) as $item) {
            $drivers[] = (new Driver)
                ->setTipo('Secundario')
                ->setTipoDoc($choferes->first()['tipoDoc'] ?? null)
                ->setNroDoc($choferes->first()['nroDoc'] ?? null)
                ->setLicencia($choferes->first()['licencia'] ?? null)
                ->setNombres($choferes->first()['nombres'] ?? null)
                ->setApellidos($choferes->first()['apellidos'] ?? null);
        }
        return $drivers;
    }
    public function getDespatchDetails($details)
    {
        $green_details = [];
        foreach ($details as $detail) {
            $green_details[] =   (new DespatchDetail())
                ->setCantidad($detail['cantidad'] ?? null) // Gravado Op. Onerosa - Catalog. 07
                ->setUnidad($detail['unidad'] ?? null)
                ->setDescripcion($detail['descripcion'] ?? null)
                ->setCodigo($detail['codigo'] ?? null);
        }
        return  $green_details;
    }
    public function  getTransportista($data)
    {
        return (new Transportist)
            ->setTipoDoc($data['tipoDoc'] ?? null)
            ->setNumDoc($data['numDoc'] ?? null)
            ->setRznSocial($data['rznSocial'] ?? null)
            ->setNroMtc($data['nroMtc'] ?? null);
    }
    //RESPONSE Y REPORTE
    public function sunatResponse($result)
    {

        $resonse['success'] = $result->isSuccess();
        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$resonse['success']) {
            // Mostrar error al conectarse a SUNAT.
            $response['error'] = [
                'code' => $result->getError()->getCode(),
                'message' => $result->getError()->getMessage()
            ];
            return $response;
        }

        $response['cdrZip'] = base64_encode($result->getCdrZip());

        $cdr = $result->getCdrResponse();

        $response['cdrResponse'] = [
            'code' => (int)$cdr->getCode(),
            'descripction' => $cdr->getDescription(),
            'notes' => $cdr->getNotes()
        ];

        return $response;
    }
    public function getHtmlReport($invoice)
    {
        $report = new HtmlReport();
        $resolver = new DefaultTemplateResolver();
        $report->setTemplate($resolver->getTemplate($invoice));

        $ruc = $invoice->getCompany()->getRuc();
        $company = Empresa::where('ruc', '20608731653')->first();
        $params = [
            'system' => [
                'logo' => file_get_contents('empresa/' . $company->logo), // Logo de Empresa
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

        return $report->render($invoice, $params);
    }
    public function generatePdfReport($invoice)
    {
        $htmlReport = new HtmlReport();
        $resolver = new DefaultTemplateResolver();
        $htmlReport->setTemplate($resolver->getTemplate($invoice));

        $ruc = $invoice->getCompany()->getRuc();
        $company = Empresa::where('ruc', '20608731653')->first();

        $report = new PdfReport($htmlReport);
        $report->setOptions([
            'no-outline',
            'viewport-size' => '1280x1024',
            'page-width' => '21cm',
            'page-height' => '29.7cm',
        ]);
        $report->setBinPath(env('WKHTMLTOPDF_PATH'));

        $params = [
            'system' => [
                'logo' => file_get_contents('empresa/' . $company->logo), // Logo de Empresa
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
        Storage::put('invoices/' . $invoice->getName() . '.pdf', $pdf);
        //file_put_contents('invoice.pdf', $pdf);


    }
}
