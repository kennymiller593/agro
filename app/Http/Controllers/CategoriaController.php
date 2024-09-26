<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $categorias = Categoria::where('estado', 1)->get();
            // Devuelve los datos en formato JSON que DataTables espera
            return response()->json([
                'data' => $categorias
            ]);
        } else {
            return view('categoria.categoria');
        }
    }
    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            $validatedData = $request->validate(
                [
                    'nombre' => 'required|string|max:255',
                ],
                [
                    'nombre.required' => 'El campo nombre es requerido',
                ]
            );

            // Crear la categoría
            $categoria = Categoria::create([
                'nombre' => $validatedData['nombre'],
                'estado' => 1
            ]);

            // Devolver respuesta JSON exitosa
            return response()->json($categoria);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capturar la excepción de validación y devolver los errores como JSON
            return response()->json([
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity
        }
    }
    public function destroy(Request $request)
    {

        try {
            // Buscar la categoría por su ID
            $category = Categoria::findOrFail($request->categoria_id);

            // Verificar si la categoría tiene productos asociados
            if ($category->productos()->exists()) {
                // Si tiene productos asociados, cambiar el estado a 0
                $category->estado = 0;
                $category->save();
                return response()->json([
                    'message' => 'La categoría tiene productos asociados. Perso será ocultado'
                ]);
            } else {
                // Si no tiene productos asociados, eliminar la categoría
                $category->delete();

                return response()->json([
                    'message' => 'Categoría eliminada exitosamente.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'Error'
            ], 422);
        }
    }
    public function edit($id)
    {
        $category = Categoria::findOrFail($id); // Utiliza el parámetro $id en lugar de $request->categoria_id
        return response()->json($category);
    }
    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate(
            [
                'nombre' => 'required|string|max:255',
                // Añade más campos según sea necesario
            ],
            [
                'nombre.required' => 'El nombre es requerido',
            ]

        );

        try {
            // Buscar la categoría por su ID
            $category = Categoria::findOrFail($id);

            // Actualizar los datos de la categoría
            $category->nombre = $validatedData['nombre'];
            // Actualizar más campos si es necesario
            $category->save();

            // Retornar respuesta JSON con los datos actualizados
            return response()->json([
                'message' => 'Categoría actualizada exitosamente.',
                'category' => $category
            ]);
        } catch (\Exception $e) {
            // Manejar cualquier error y devolver una respuesta de error
            return response()->json([
                'errors' => 'Error al actualizar la categoría.',
            ], 422);
        }
    }
}
