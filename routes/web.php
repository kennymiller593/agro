<?php

use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ComprobanteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InternetHogarController;
use App\Http\Controllers\PagoRealizadosController;
use App\Http\Controllers\PagosPendientesController;
use App\Http\Controllers\posController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RentabilidadController;
use App\Models\Empresa;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('crear-clientes', [ClientesController::class, 'formCreate'])->name('client.create');

Route::post('/guardar-cliente-inst', [ClientesController::class, 'saveInstalacion'])->name('clientes.saveInst');


Route::post('/consulta-dni', [ClientesController::class, 'consultaDni'])->name('consulta.dni');


Route::post('crear-empresa', [EmpresaController::class, 'create'])->name('empresa.create');

Route::get('dashboard', [DashboardController::class, 'show'])->name('dash.admin');

Route::get('home', [HomeController::class, 'home'])->name('home');




Route::get('invoices/send', [InvoiceController::class, 'send']);
Route::get('invoices/xml', [InvoiceController::class, 'xml']);

Route::get('tester', function () {
    // Aquí puedes escribir el código de tu función anónima
    $company = Empresa::where('ruc', '20608731653')->first();
    // return Storage::get($company->logo);
});


//AGRO
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'show'])->name('dash.admin');

    Route::get('productos', [ProductoController::class, 'showProduct'])->name('verProducto');
    Route::post('/add-prod', [ProductoController::class, 'addProd'])->name('addProd');

    Route::get('pos', [posController::class, 'show'])->name('vender');
    Route::post('/add-to-cart/{product}', [PosController::class, 'addToCart'])->name('cart.add');
    Route::delete('/remove-from-cart/{product}', [PosController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('update-cart', [PosController::class, 'updateCart'])->name('cart.update');
    Route::post('/process-payment', [PosController::class, 'processPayment'])->name('payment.process');
    Route::get('/generate-pdf/{success_id}', [PosController::class, 'generatePDF'])->name('generate.pdf');
    Route::post('/guardar-cliente', [ClientesController::class, 'save'])->name('clientes.save');

    Route::get('listar-comprobantes', [ComprobanteController::class, 'showComprobante'])->name('verComprobante');
    Route::get('/search', [PosController::class, 'search']); //PARA VENTA
    Route::get('/search-prod', [ProductoController::class, 'search']); //PARA AGREGAR PROD

    Route::post('/api/products/{id}', [ProductoController::class, 'update']);
    Route::get('/productos/{id}', [ProductoController::class, 'edit']);
    Route::delete('/delete/products/{id}', [ProductoController::class, 'destroy']);

    Route::get('caja-arqueo', [CajaController::class, 'showCaja'])->name('verCaja');
    Route::post('/add-caja', [CajaController::class, 'addIngEgr'])->name('addIngEgr');
    Route::post('/add-arqueo', [CajaController::class, 'addCerrarCaja'])->name('addArqueo');

    Route::post('/abrir-caja', [CajaController::class, 'abrirCaja'])->name('caja.open');
    Route::get('comprar-producto', [ProductoController::class, 'comprarProd'])->name('comprar.producto');

    Route::post('/add-to-cart-compra/{product}', [ProductoController::class, 'addToCart'])->name('cart.add.compra');
    Route::delete('/remove-from-cart-compra/{product}', [ProductoController::class, 'removeFromCart'])->name('cart.remove.compra');
    Route::post('update-cart-compra', [ProductoController::class, 'updateCart'])->name('cart.update.compra');

    Route::post('/process-payment-compra', [ProductoController::class, 'processPayment'])->name('payment.process.compra');
    Route::get('/search-prod-compra', [ProductoController::class, 'searchProdCompra'])->name('search.prod.compra'); //PARA COMPRA

    Route::get('/listar-caja', [CajaController::class, 'listarCaja'])->name('listar.caja');

    Route::get('/rentabilidad-de-productos', [RentabilidadController::class, 'show'])->name('listar.prodrentable');
    Route::post('/rentabilidad-de-productos2', [RentabilidadController::class, 'filtrarRentabilidad'])->name('listar.prodrentable2');


    Route::get('/rentabilidad-de-app', [RentabilidadController::class, 'showsito'])->name('listar.prodrentable3');
    Route::post('/rentabilidad-de-app2', [RentabilidadController::class, 'showsitoperro'])->name('listar.prodrentable4');


    Route::get('/historial-compra/{id}', [ProductoController::class, 'historialCompras'])->name('producto.historialcompras');
    Route::get('/historial-venta/{id}', [ProductoController::class, 'historialVentas'])->name('producto.historialventas');


    Route::get('proveedores', [ProveedorController::class, 'show'])->name('proveedor.index');
    Route::post('/registrar-proveedor', [ProveedorController::class, 'registrarProveedor'])->name('registrar.proveedor');
    Route::delete('/proveedores/destroy', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
    Route::get('/proveedores/{id}', [ProveedorController::class, 'edit']);
    Route::post('/update-proveedor', [ProveedorController::class, 'update'])->name('update.proveedor');

    Route::get('clientes', [ClientesController::class, 'index'])->name('clientes.index');
    Route::post('/registrar-cliente', [ClientesController::class, 'registrarCliente'])->name('registrar.cliente');
    Route::get('/clientes/{id}', [ClientesController::class, 'edit']);
    Route::post('/update-cliente', [ClientesController::class, 'update'])->name('update.cliente');
    Route::delete('/clientes/destroy', [ClientesController::class, 'destroy'])->name('clientes.destroy');


    Route::get('categorias', [CategoriaController::class, 'show'])->name('categoria.show');
    Route::post('/categorias-add', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::delete('/delete/category', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
    Route::get('/edit/category/{id}', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/update/category/{id}', [CategoriaController::class, 'update'])->name('categorias.update');


    Route::delete('/delete/comprobante', [ComprobanteController::class, 'destroy'])->name('comprobante.destroy');

    Route::get('mi-empresa', [EmpresaController::class, 'show'])->name('empresa.view');
    Route::get('/edit/empresa/{id}', [EmpresaController::class, 'edit'])->name('empresa.edit');
    Route::post('/update/empresa/{id}', [EmpresaController::class, 'update'])->name('empresa.update');

    Route::get('listar-compra', [CompraController::class, 'listarCompra'])->name('listar.compra');
    Route::get('/detalle-compra/{id}', [CompraController::class, 'detalleCompra'])->name('detalle.compra');
    /*Route::get('ingreso', function () {
        return view('producto.compra');
    });*/
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
/*Route::get('login', function () {
    return view('login');
});*/
