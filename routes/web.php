<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InternetHogarController;
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
Route::get('home', [HomeController::class, 'home'])->name('home');
Route::get('internet-hogar', [InternetHogarController::class, 'index'])->name('internet.hogar');
Route::get('internet-negocios', [InternetHogarController::class, 'negocio'])->name('internet.negocio');
