<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Medida;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //
    public function showProduct(Request $request)
    {
        if ($request->ajax()) {

            $productos = Producto::with(['unimedida'])->orderBy('id', 'desc')->get();
            return response()->json(['data' => $productos]);
        } else {
            $categorias = Categoria::orderBy('id', 'desc')->get();
            $proveedores = Proveedor::orderBy('id', 'desc')->get();
            $medidas = Medida::orderBy('id', 'desc')->get();
        }
        return view('producto.producto', compact('categorias', 'proveedores', 'medidas'));
    }
    public function addProd(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'txtprod' => 'required|string|max:255',
                'txtdesc' => 'nullable|string|max:255',
                'txtstock' => 'required|integer|min:0',
                'txtprecio_uv' => 'required|numeric|min:0',
            ],
            [
                'txtprod.required' => 'El campo Nombre del producto es obligatorio',
                'txtstock.required' => 'El campo stock es obligatorio',
                'txtprecio_uv.required' => 'El campo precio es obligatorio',
                'txtprecio_uv.numeric' => 'El campo precio es numérico',
                'txtstock.numeric' => 'El campo stock es numérico',
            ]
        );

        // Si la validación falla, devolver errores con código 422
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }



        $producto = $request->input('txtprod');
        $descripcion = $request->input('txtdesc');
        $categoria_id = $request->input('txtid_cat');
        $proveedor_id = $request->input('txtid_prov');
        $medida_id = $request->input('txtid_med');
        $stock = $request->input('txtstock');
        $precio_unitario_venta = $request->input('txtprecio_uv');
        $precio_unitario_compra = $request->input('txtprecio_co');

        $imagePath = 'producto/8676496.png';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('producto');
            $image->move($destinationPath, $imageName);

            // Actualizar la ruta de la imagen para que sea accesible públicamente
            $imagePath = 'producto/' . $imageName;
        }

        // Obtener el máximo ID actual y sumar 1
        $maxId = Producto::max('id');
        $nextId = $maxId + 1;
        $codigoProducto = 'PROD' . $nextId;
        // Realizar las operaciones necesarias con los datos recibidos
        $procesarPago = Producto::create([
            'nombre' => $producto,
            'codigo' =>  $codigoProducto,
            'descripcion' => $descripcion,
            'precio_venta' => $precio_unitario_venta,
            'stok' => $stock,
            'estado' => 1,
            'precio_compra' => $precio_unitario_compra,
            'categoria_id' => $categoria_id,
            'medida_id' =>  $medida_id,
            'imagen' => $imagePath,
            'proveedor_id' => $proveedor_id,
            'sucursal_id' => 1,
        ]);
        return response()->json(['message' => 'Producto agregado correctamente:']);
    }
}
