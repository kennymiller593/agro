<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Services\SunatService;
use Greenter\Report\XmlUtils;
use Illuminate\Http\Request;

class DespatchController extends Controller
{
    //
    public function send(Request $request)
    {
        $data = $request->all();
        $company = Empresa::where('ruc', '20608731653')->first();


        $sunat = new SunatService();
        $despatch = $sunat->getDespatch($data);

        $api = $sunat->getSeeApi($company);

        $result = $api->send($despatch);

        $ticket = $result->getTicket();
        $api->getStatus($ticket);

        $response['xml'] = $api->getLastXml();
        $response['hash'] = (new XmlUtils())->getHashSign($response['xml']);
        $response['sunatResponse'] = $sunat->sunatResponse($result);

        return response()->json($response);
    }
    public function xml(Request $request)
    {
        $empresa = Empresa::where('ruc', '20608731653')->first();
        $data = $request->all();

        $sunat = new SunatService();
        $see = $sunat->getSee($empresa);

        $invoice = $sunat->getDespatch($data);

        $response['xml'] = $see->getXmlSigned($invoice);
        $response['hash'] = (new XmlUtils())->getHashSign($response['xml']);
        return response()->json($response, 200);
    }
    public function pdf(Request $request)
    {
        $empresa = Empresa::where('ruc', '20608731653')->first();
        $data = $request->all();

        $sunat = new SunatService();

        $despatch = $sunat->getDespatch($data);
       
       // $sunat->generatePdfReport($invoice);
        return $sunat->getHtmlReport($despatch);
    }
}
