<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Categoria;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Medida;
use App\Models\Producto;
use App\Models\Proveedor;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    //
    public function showProduct(Request $request)
    {
        /*if ($request->ajax()) {

            $productos = Producto::with(['unimedida'])->orderBy('id', 'desc')->get();
            return response()->json(['data' => $productos]);
        } else {
            $categorias = Categoria::orderBy('id', 'desc')->get();
            $proveedores = Proveedor::orderBy('id', 'desc')->get();
            $medidas = Medida::orderBy('id', 'desc')->get();
        }*/
        $productos = Producto::where('estado', 1)->orderBy('nombre', 'asc')->get();
        $categorias = Categoria::orderBy('id', 'desc')->get();
        $proveedores = Proveedor::orderBy('id', 'desc')->get();
        $medidas = Medida::orderBy('id', 'desc')->get();
        return view('producto.producto', compact('productos', 'categorias', 'proveedores', 'medidas'));
    }
    public function historialCompras($id)
    {
        $producto = Producto::findOrFail($id);
        $historial = $producto->historialCompras;


        return view('producto.historial-compras', compact('historial'))->render();
        // return response()->json($historial);
    }
    public function historialVentas($id)
    {
        $producto = Producto::findOrFail($id);
        $historial = $producto->detalleVentas;


        return view('producto.historial-ventas', compact('historial'))->render();
        // return response()->json($historial);
    }
    public function addProd(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'txtprod' => 'required|string|max:255|unique:producto,nombre',
                'txtdesc' => 'nullable|string|max:255',
                'txtstock' => 'required|integer|min:0',
                'txtprecio_uv' => 'required|numeric|min:0',
                'txtprecio_co' => 'required|numeric|min:0',  // Añadir esta validación si es necesario
            ],
            [
                'txtprod.required' => 'El campo Nombre del producto es obligatorio',
                'txtprod.unique' => 'Ya hay un producto registrado con este nombre',
                'txtstock.required' => 'El campo stock es obligatorio',
                'txtstock.integer' => 'El campo stock debe ser un número entero',
                'txtprecio_uv.required' => 'El campo precio es obligatorio',
                'txtprecio_uv.numeric' => 'El campo precio debe ser numérico',
                'txtprecio_co.required' => 'El campo precio de compra es obligatorio',
                'txtprecio_co.numeric' => 'El campo precio de compra debe ser numérico',
            ]
        );

        // Si la validación falla, devolver errores con código 422
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Iniciar la transacción de base de datos
        DB::beginTransaction();

        try {
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

            // Crear el nuevo producto
            $procesarPago = Producto::create([
                'nombre' => $producto,
                'codigo' =>  $codigoProducto,
                'descripcion' => $descripcion,
                'precio_venta' => $precio_unitario_venta,
                'stok' => $stock,  // Corrige a 'stock' si es un error tipográfico
                'estado' => 1,
                'precio_compra' =>  $precio_unitario_compra,
                'categoria_id' => $categoria_id,
                'medida_id' =>  $medida_id,
                'imagen' => $imagePath,
                'proveedor_id' => $proveedor_id,
                'sucursal_id' => 1,
            ]);

            // Verificar si hay caja abierta para el usuario actual
            $cajaAbierta = Caja::where('estado', 'abierto')
                ->where('usuario_id', Auth::user()->id)
                ->first();

            if (!$cajaAbierta) {
                throw new Exception('No hay caja abierta para este usuario, asegurate abrir la caja chica');
            }


            if ($stock>0 ) {
                // Crear la compra
                $addCompra = Compra::create([
                    'tipo_movimiento' => 1,
                    'proveedor_id' => $proveedor_id,
                    'usuario_id' =>  Auth::user()->id,
                    'caja_id' => $cajaAbierta->id,
                    'fecha' => now(),
                    'total' => $stock * $precio_unitario_compra
                ]);

                // Crear el detalle de la compra
                $addDetalleCompra = DetalleCompra::create([
                    'compra_id' => $addCompra->id,
                    'producto_id' => $procesarPago->id,
                    'cantidad' => $stock,
                    'precio_compra' => $precio_unitario_compra,
                    'cantidad_restante' => $stock,
                ]);
            }

            // Confirmar la transacción
            DB::commit();

            // Obtener los productos actualizados para la vista
            $productos = Producto::where('estado', 1)->orderBy('nombre', 'asc')->get();

            return view('producto.partial-prod', compact('productos'))->render();
        } catch (\Exception $e) {
            // Si ocurre un error, revertir la transacción
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $productos = Producto::where('nombre', 'LIKE', "%{$query}%")->orderBy('nombre', 'asc')->get();
        return view('producto.partial-prod', compact('productos'))->render();
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return response()->json($producto);
    }

    public function update(Request $request, $id)
    {

        //var_dump($request->txtprodE);
        $validator = Validator::make(
            $request->all(),
            [
                'txtprodE' => 'required|string|max:255',
                'txtstockE' => 'required|numeric|min:0',
                'txtprecio_uvE' => 'required|numeric|min:0',
            ],
            [
                'txtprodE.required' => 'El campo Nombre del producto es obligatorio',
                'txtstockE.required' => 'El campo stock es obligatorio',
                'txtprecio_uvE.required' => 'El campo precio es obligatorio',
                'txtprecio_uvE.numeric' => 'El campo precio es numérico',
                'txtstockE.numeric' => 'El campo stock es numérico',
            ]
        );

        // Si la validación falla, devolver errores con código 422
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        /* if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('producto');
            $image->move($destinationPath, $imageName);

            // Actualizar la ruta de la imagen para que sea accesible públicamente
            $imagePath = 'producto/' . $imageName;
        }*/
        $product = Producto::findOrFail($id);
        $product->nombre = $request->input('txtprodE');
        $product->descripcion = $request->input('txtdescE');
        $product->precio_venta = $request->input('txtprecio_uvE');
        $product->stok = $request->input('txtstockE');
        $product->estado = 1;
        $product->precio_compra = $request->input('txtprecio_coE');
        $product->categoria_id = $request->input('txtidE_cat');
        $product->medida_id =   $request->input('txtidE_med');

        if ($request->hasFile('imageE')) {
            $image = $request->file('imageE');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('producto');
            $image->move($destinationPath, $imageName);
            $imagePath = 'producto/' . $imageName;
            $product->imagen = $imagePath;
            /* $imagePath = $request->file('imageE')->store('product_images', 'public');
            $product->imagen = $imagePath;*/
        }

        $product->proveedor_id = $request->input('txtidE_prov');
        $product->sucursal_id = 1;
        $product->save();

        $productos = Producto::where('estado', 1)->orderBy('nombre', 'asc')->get();

        return view('producto.partial-prod', compact('productos'))->render();
    }
    public function destroy($id)
    {
        $product = Producto::findOrFail($id);
        $product->estado = 0;
        $product->save();
        $productos = Producto::where('estado', 1)->orderBy('nombre', 'asc')->get();
        //return response()->json(['success' => true]);
        return view('producto.partial-prod', compact('productos'))->render();
    }

    public function comprarProd()
    {

        $productos = Producto::where('estado', 1)->orderBy('nombre', 'asc')->get();
        $proveedores = Proveedor::orderBy('id', 'desc')->get();
        $cajaAbierta = Caja::where('estado', 'abierto')
            ->where('usuario_id', Auth::user()->id)
            ->first();

        $cartcompra = session()->get('cart-compra', []);
        return view('producto.compra', compact('productos', 'cartcompra', 'proveedores', 'cajaAbierta'));
    }
    public function addTocart(Request $request, Producto $product)
    {
        $cartcompra = session()->get('cart-compra', []);

        if (isset($cartcompra[$product->id])) {
            $cartcompra[$product->id]['quantity']++;
        } else {
            $cartcompra[$product->id] = [
                "name" => $product->nombre,
                "quantity" => 1,
                "price" => $product->precio_compra,
                "uni_medida" => $product->unimedida->simbolo_sunat,
                "id" => $product->id,
            ];
        }

        session()->put('cart-compra', $cartcompra);
        return view('producto.formulario', compact('cartcompra'));
    }
    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity && $request->price) {
            $cartcompra = session()->get('cart-compra');
            $cartcompra[$request->id]["quantity"] = $request->quantity;
            $cartcompra[$request->id]["price"] = $request->price;
            session()->put('cart-compra', $cartcompra);

            // Recalcular el total
            $total = 0;
            foreach ($cartcompra as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            return view('producto.formulario', compact('cartcompra'));
        }
    }
    public function removeFromCart(Request $request, $productId)
    {
        $cartcompra  = session()->get('cart-compra', []);

        if (isset($cartcompra[$productId])) {
            unset($cartcompra[$productId]);
            session()->put('cart-compra',  $cartcompra);
        }

        return view('producto.formulario', compact('cartcompra'));
    }

    public function processPayment(Request $request)
    {
        $cart = session()->get('cart-compra', []);

        // Aquí iría la lógica para procesar el pago
        // Por ejemplo, integración con una pasarela de pago

        // Por ahora, simplemente calcularemos el total

        $caja = Caja::where('estado', 'abierto')
            ->where('usuario_id', Auth::user()->id)->first();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Aquí podrías guardar la orden en la base de datos


        $procesarCompra = Compra::create([
            'tipo_movimiento' =>  $request->tipo_movimiento,
            'fecha' => $request->fecha,
            'total' => $total,
            'proveedor_id' =>  $request->proveedor_id,
            'usuario_id' => Auth::user()->id,
            'caja_id' => $caja->id
        ]);



        $total_partial = 0;
        foreach ($cart as $item) {
            $total_partial = $item['price'] * $item['quantity'];
            $procesarDetalle = DetalleCompra::create([
                'compra_id' => $procesarCompra->id,
                'producto_id' =>  $item['id'],
                'cantidad' => $item['quantity'],
                'precio_compra' => $item['price'],
                'cantidad_restante' => $item['quantity'],
            ]);

            // Encuentra el producto y actualiza el stock
            $producto = Producto::find($item['id']);
            if ($producto) {
                $producto->stok += $item['quantity'];
                $producto->save();
            }
        }

        // Limpiamos el carrito después de procesar el pago
        session()->forget('cart-compra');

        return response()->json([
            'success' => true,
            'message' => 'Compra procesado correctamente',
            'total' => $total,
            'success_id' => $procesarCompra->id,
        ]);
    }
    public function searchProdCompra(Request $request)
    {
        $query = $request->input('query');
        $productos = Producto::where('nombre', 'LIKE', "%{$query}%")->where('estado', 1)->orderBy('nombre', 'asc')->get();
        return view('producto.table-compra', compact('productos'))->render();
    }
}
