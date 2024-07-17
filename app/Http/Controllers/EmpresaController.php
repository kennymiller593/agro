<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Validation\ValidationException;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    //
    public function show()
    {
        $empresa = Empresa::where('ruc', '20608731653')->first();
        return view('empresa.create',compact('empresa'));
    }
    public function create(Request $request)
    {

        $existingEmpresa = Empresa::where('ruc', $request->ruc)->first();

        // Si existe, muestra un mensaje de error y detiene el proceso
        if ($existingEmpresa) {
            // Validar los datos del formulario
            $request->validate([
                'razon_social' => 'required|string|max:455',
                'descripcion' => 'required|string|max:200',
                'direccion' => 'required',
                'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la foto, si es editable
            ], [
                'razon_social.required' => 'El campo Nombre es obligatorio',
                'descripcion.required' => 'El campo descripción es requerido',
                'direccion.required' => 'El campo dirección es requerido',
                // Agrega otras reglas de validación según sea necesario
            ]);

            // Actualizar los datos de la empresa con los valores del formulario
             $existingEmpresa->razon_social = $request->razon_social;
             $existingEmpresa->ruc = $request->ruc;
             $existingEmpresa->descripcion = $request->descripcion;
             $existingEmpresa->telefono = $request->telefono;
             $existingEmpresa->direccion = $request->direccion;

            // Si se proporcionó una nueva foto, actualizarla
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $nombrelogo = time() . '.' . $logo->getClientOriginalExtension();
                $ruta = public_path('/empresa'); // Ruta donde deseas guardar la logo
                $logo->move($ruta, $nombrelogo);
                 $existingEmpresa->logo = $nombrelogo;
            }

            // Guardar los cambios en la base de datos
             $existingEmpresa->save();

            // Redirigir con un mensaje de éxito
            return redirect()->route('empresa.view')->with('success', '¡La empresa se ha actualizado exitosamente!');

           // return redirect()->back()->withErrors(['ruc' => 'Este RUC ya se encuentra registrado'])->withInput();
        }

        try {
           /* if ($request->hasFile('logo')) {

                $request->validate(
                    [
                        'razon_social' => 'required|string|max:455',
                        'ruc' => 'required|unique:empresa,ruc',
                        'descripcion' => 'required|string|max:200',
                        'direccion' => 'required',
                    ],

                    [
                        'razon_social.required' => 'El campo Nombre es obligatorio',
                        'apellidos.required' => 'El campo apellidos es obligatorio',
                        'ruc.unique' => 'Este RUC ya se enuentra registrado',
                        'descripcion.required' => 'El campo descripcion es requerido',
                        'direccion.required' => 'El campo dirección es requerido',
                    ]
                );
                $logo = $request->file('logo');
                $nombrelogo = time() . '.' . $logo->getClientOriginalExtension();
                $ruta = public_path('/empresa'); // Ruta donde deseas guardar la logo
                $logo->move($ruta, $nombrelogo);


                $empresa = Empresa::create([
                    'razon_social' => $request->razon_social,
                    'ruc' => $request->ruc,
                    'descripcion' => $request->descripcion,
                    'telefono' => $request->telefono,
                    'direccion' => $request->direccion,
                    'fecha_registro' => now(),
                    'estado' => 1,
                    'logo' => $nombrelogo,
                ]);
                return redirect()->route('empresa.view')->with('success', '¡La empresa se ha registrado exitosamente!');
            }*/
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return redirect()->back()->withInput($request->all())->withErrors($errors);
        }
    }
}
