<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Validation\ValidationException;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    //
    public function show(Request $request)
    {

        if ($request->ajax()) {
            $empresa = Empresa::get();
            // Devuelve los datos en formato JSON que DataTables espera
            return response()->json([
                'data' => $empresa
            ]);
        } else {
            return view('empresa.empresa');
        }
    }
    public function edit($id)
    {
        $empresa = Empresa::findOrFail($id); // Utiliza el parámetro $id en lugar de $request->categoria_id
        return response()->json($empresa);
    }
    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate(
            [
                'ruc' => 'required|string|max:20',
                'razon_social' => 'required|string|max:180',
                'nombre_comercial' => 'required|string|max:180',
                'telefono' => 'required|string|max:20',
                // Añade más campos según sea necesario
            ],
            [
                'ruc.required' => 'El ruc/dni es requerido',
                'razon_social.required' => 'Razon social es requerido',
                'nombre_comercial.required' => 'El nombre comercial es requerido',
                'telefono.required' => 'El telefono es requerido',
            ]

        );

        try {
            // Buscar la categoría por su ID
            $empresa = Empresa::findOrFail($id);

            // Actualizar los datos de la categoría
            $empresa->ruc = $validatedData['ruc'];
            $empresa->razon_social = $validatedData['razon_social'];
            $empresa->nombre_comercial = $validatedData['nombre_comercial'];
            $empresa->telefono = $validatedData['telefono'];
            $empresa->direccion = $request->direccion;
            $empresa->descripcion = $request->descripcion;
            if ($request->hasFile('logo')) {
                // Eliminar el logo anterior si existe
                $image = $request->file('logo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('empresa');
                $image->move($destinationPath, $imageName);
                $imagePath = 'empresa/' . $imageName;
                $empresa->logo = $imagePath;

                // Guardar el nuevo logo
                //$path = $request->file('logo')->store('public/empresa');
               // $empresa->logo = $path;
            }

            // Actualizar más campos si es necesario
            $empresa->save();

            // Retornar respuesta JSON con los datos actualizados
            return response()->json([
                'message' => 'Empresa actualizada exitosamente.',
                'empresa' => $empresa
            ]);
        } catch (\Exception $e) {
            // Manejar cualquier error y devolver una respuesta de error
            return response()->json([
                'errors' => 'Error al actualizar la Empresa.' . $e->getMessage(),
            ], 422);
        }
    }
}
