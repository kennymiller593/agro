<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Instalacion;
use App\Models\Plan;
use App\Models\Zona;
use Illuminate\Http\Request; //recupera datos;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Catch_;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        /* $instalaciones = Instalacion::with(['cliente', 'plan'])
        ->get();
        return view('clientes', compact('instalaciones'));*/
        // return view('clientes');
        if ($request->ajax()) {

            $instalaciones = Instalacion::with(['cliente', 'plan', 'zona'])->orderBy('id', 'desc')->get();
            return response()->json(['data' => $instalaciones]);
        }

        return view('clientes');
    }
    public function formCreate()
    {
        $planes = Plan::all();
        $zonas = Zona::all();
        return view('clientes.create', compact('planes', 'zonas'));
    }
    public function consultaDni(Request $request)
    {
        $token = 'apis-token-7458.pQVW2cM9kp13YeuCQg0ulFYypUxgSynP';
        $numero = $request->input('dni');
        if (strlen($numero) == 8) {
            $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);
            $parameters = [
                'http_errors' => false,
                'connect_timeout' => 5,
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Referer' => 'https://apis.net.pe/api-consulta-dni',
                    'User-Agent' => 'laravel/guzzle',
                    'Accept' => 'application/json',
                ],
                'query' => ['numero' => $numero]
            ];
            // Para usar la versión 1 de la api, cambiar a /v1/dni
            $res = $client->request('GET', '/v2/reniec/dni', $parameters);
            $response = json_decode($res->getBody()->getContents(), true);
        } elseif (strlen($numero) == 11) {
            $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);

            $parameters = [
                'http_errors' => false,
                'connect_timeout' => 5,
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Referer' => 'https://apis.net.pe/api-consulta-ruc',
                    'User-Agent' => 'laravel/guzzle',
                    'Accept' => 'application/json',
                ],
                'query' => ['numero' => $numero]
            ];
            // Para usar la versión 1 de la api, cambiar a /v1/ruc
            $res = $client->request('GET', '/v2/sunat/ruc', $parameters);
            $response = json_decode($res->getBody()->getContents(), true);
        }
        return response()->json($response);
    }
    public function save(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nombre' => 'required|string|max:500',
                'num_doc' => 'required|unique:cliente,num_doc|integer',

            ],

            [
                'nombre.required' => 'El campo Nombre es obligatorio',
                'num_doc.required' => 'El campo Número de documento es obligatorio',
                'num_doc.unique' => 'Este cliente ya se encuentra registrado',

            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $nuevoCliente = Cliente::create([
            'nombres' => $request->input('nombre'),
            'apellidos' => $request->input('nombre-comercial'),
            'tipo_persona' => 'Natural',
            'tipo_doc' => $request->input('tipo-doc'),
            'num_doc' => $request->input('num_doc'),
            'direccion' => $request->input('direccion'),
            'telefono' =>  $request->input('telefono'),
        ]);

        return response()->json([
            'message' => 'Cliente agregado correctamente:',
            'cliente_id' => $nuevoCliente->id
        ]);
    }
    public function saveInstalacion(Request $request)
    {
        try {
            $request->validate(
                [
                    'ip' => 'required|string|max:255',
                    'direccion' => 'required|string|max:255',
                    'url_maps' => 'required|string|max:255',
                    'fecha_inst' => 'required',
                    'dia_cobro' => 'required',

                ],

                [
                    'ip.required' => 'El campo ip es obligatorio',
                    'direccion.required' => 'El campo direccion es obligatorio',
                    'url_maps.required' => 'El campo url es requerido',
                    'fecha_inst.required' => 'Complete este campo',
                    'dia_cobro.required' => 'Complete este campo',
                ]
            );
            $nuevoCliente = Instalacion::create([
                'cliente_id' => $request->cliente_id,
                'plan_id' => $request->plan_id,
                'fecha_instalacion' =>  $request->fecha_inst,
                'dia_cobro' => $request->dia_cobro,
                'zona_id' => $request->zona_id,
                'router_id' => $request->router_id,
                'users_id' => 1,
                'ip' => $request->ip,
                'url_maps' => $request->url_maps,
                'distrito' => $request->distrito,
                'direccion' => $request->direccion,
                'descripcion' => $request->descripcion,
                'estado' => 'Activo',
            ]);
            Session::flush();
            return redirect()->route('clientes.index');
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return redirect()->back()->withInput($request->all())->withErrors($errors);
        }
    }
}
