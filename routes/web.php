<?php

use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InternetHogarController;
use App\Http\Controllers\PagoRealizadosController;
use App\Http\Controllers\PagosPendientesController;
use App\Http\Controllers\posController;
use App\Http\Controllers\ProductoController;
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
Route::get('clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('crear-clientes', [ClientesController::class, 'formCreate'])->name('client.create');
Route::post('crear-pendientes', [PagosPendientesController::class, 'generarPendiente'])->name('generar.pendiente');

Route::post('/guardar-cliente-inst', [ClientesController::class, 'saveInstalacion'])->name('clientes.saveInst');
Route::get('pagos-pendientes', [PagosPendientesController::class, 'show'])->name('pagos.pendientes');
Route::get('pagos-realizados', [PagoRealizadosController::class, 'pagoRealizados'])->name('pagos.realizados');

Route::post('/consulta-dni', [ClientesController::class, 'consultaDni'])->name('consulta.dni');

Route::get('mi-empresa', [EmpresaController::class, 'show'])->name('empresa.view');
Route::post('crear-empresa', [EmpresaController::class, 'create'])->name('empresa.create');

Route::get('dashboard', [DashboardController::class, 'show'])->name('dash.admin');

Route::get('home', [HomeController::class, 'home'])->name('home');
Route::get('internet-hogar', [InternetHogarController::class, 'index'])->name('internet.hogar');
Route::get('internet-negocios', [InternetHogarController::class, 'negocio'])->name('internet.negocio');



Route::get('invoices/send', [InvoiceController::class, 'send']);
Route::get('invoices/xml', [InvoiceController::class, 'xml']);

Route::get('tester', function () {
    // Aquí puedes escribir el código de tu función anónima
    $company = Empresa::where('ruc', '20608731653')->first();
    // return Storage::get($company->logo);
});


//AGRO

Route::get('productos', [ProductoController::class, 'showProduct'])->name('verProducto');
Route::post('/add-prod', [ProductoController::class, 'addProd'])->name('addProd');

Route::get('pos', [posController::class, 'show'])->name('vender');
Route::post('/add-to-cart/{product}', [PosController::class, 'addToCart'])->name('cart.add');
Route::delete('/remove-from-cart/{product}', [PosController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/process-payment', [PosController::class, 'processPayment'])->name('payment.process');
Route::get('/generate-pdf/{success_id}', [PosController::class, 'generatePDF'])->name('generate.pdf');
Route::post('/guardar-cliente', [ClientesController::class, 'save'])->name('clientes.save');

Route::get('listar-comprobantes', [PosController::class, 'showComprobante'])->name('verComprobante');
Route::get('/search', [PosController::class, 'search']);


Route::get('g-pdf', function () {
    return view('pos.invoice');
});
