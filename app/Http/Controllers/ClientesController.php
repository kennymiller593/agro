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
        $clientes = Cliente::all();

        return view('clientes.listar', compact('clientes'));
    }
    public function formCreate() {}
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
    public function registrarCliente(Request $request)
    {
        $validatedData = $request->validate(
            [
                'numero' => 'required|numeric|min:0|unique:cliente,num_doc',
                'rs' => 'required',
            ],
            [
                'numero.required' => 'Ingrese número',
                'numero.numeric' => 'El campo número debe ser un valor numérico',
                'numero.unique' => 'El número ya se encuentra registrado',
                'rs.required' => 'El nombre es obligatorio',
            ]
        );

        try {
            $proveedor = Cliente::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'tipo_persona' => $request->tipo_doc == '1' ? 'Natural' : ($request->tipo_doc == '2' ? 'Jurídica' : null),
                'tipo_doc' => $request->tipo_doc,
                'num_doc' => $request->numero,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                // Otros campos según sea necesario
            ]);

            return redirect()->back()->with('message', 'Proveedor agregado con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al registrar'])->withInput();
        }
    }
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json($cliente);
    }

    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'numeroE' => 'required|string',
                'rsE' => 'required|string',
            ],
            [
                'numeroE.required' => 'Ingrese número',
                'numeroE.numeric' => 'El campo número debe ser un valor numérico',
                'numeroE.min' => 'El número debe ser igual o mayor que 0',
                'rsE.required' => 'El nombre es obligatorio',
            ]
        );


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Buscar el proveedor por ID
            $proveedor = Cliente::findOrFail($request->idE);

            // Actualizar los datos
            $proveedor->update([
                'nombres' => $request->nombresE,
                'apellidos' => $request->apellidosE,
                'tipo_persona' => $request->tipo_docE == '1' ? 'Natural' : ($request->tipo_docE == '2' ? 'Jurídica' : null),
                'tipo_doc' => $request->tipo_docE,
                'num_doc' => $request->numeroE,
                'direccion' => $request->direccionE,
                'telefono' => $request->telefonoE,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cliente actualizado correctamente'
            ]);
        } catch (\Exception $e) {
            // Manejar cualquier error durante la actualización
            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Error al actualizar el cliente']
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $cliente = Cliente::findOrFail($request->cliente_id);
            $cliente->delete();

            return redirect()->back()->with('message', 'Cliente eliminado con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al eliminar el cliente']);
        }
    }
}
