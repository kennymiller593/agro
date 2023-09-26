<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request; //recupera datos;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        // return view('clientes');
        if ($request->ajax()) {
          //  $clientesa =  DB::select('call SP_listClientes()');
            $clientes = Cliente::select('id', 'nombre', 'apellidos', 'dni', 'celular', 'direccion', 'urlmaps')->get();
            return Datatables::of($clientes)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = 'cs'.$row->id;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('clientes');
    }
}
