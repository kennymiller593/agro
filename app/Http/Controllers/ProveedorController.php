<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    //
    public function show()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.listar', compact('proveedores'));
    }
    public function registrarProveedor(Request $request)
    {
        $validatedData = $request->validate(
            [
                'numero' => 'required|numeric|min:0|unique:proveedor,ruc',
                'rs' => 'required',
            ],
            [
                'numero.required' => 'Ingrese número',
                'numero.numeric' => 'El campo número debe ser un valor numérico',
                'numero.min' => 'El número debe ser igual o mayor que 0',
                'rs.required' => 'La razón social es obligatorio',
            ]
        );

        try {
            $proveedor = Proveedor::create([
                'razon_social' => $request->rs,
                'nombre_comercial' => $request->nombre_comercial,
                'ruc' => $request->numero,
                'tipo_doc' => $request->tipo_doc,
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
        $proveedor = Proveedor::findOrFail($id);
        return response()->json($proveedor);
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
                'numeroE.unique' => 'El DNI/RUC ya está registrado',
                'rsE.required' => 'La razón social es obligatorio',
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
            $proveedor = Proveedor::findOrFail($request->idE);

            // Actualizar los datos
            $proveedor->update([
                'tipo_doc' => $request->tipo_docE,
                'ruc' => $request->numeroE,
                'razon_social' => $request->rsE,
                'nombre_comercial' => $request->nombre_comercialE,
                'direccion' => $request->direccionE,
                'telefono' => $request->telefonoE,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Proveedor actualizado correctamente'
            ]);
        } catch (\Exception $e) {
            // Manejar cualquier error durante la actualización
            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Error al actualizar el proveedor']
            ], 500);
        }
    }
    public function destroy(Request $request)
    {
        try {
            $proveedor = Proveedor::findOrFail($request->proveedor_id);
            $proveedor->delete();

            return redirect()->back()->with('message', 'Proveedor eliminado con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al eliminar el proveedor']);
        }
    }
}
