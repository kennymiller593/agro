<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DespatchController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\RegisterEmpresa;
use Greenter\Model\Despatch\Despatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/




Route::post('register', [RegisterEmpresa::class, 'store']);

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('me',  [AuthController::class, 'me']);


//Invoice
Route::post('invoices/send',[InvoiceController::class,'send']);
Route::post('invoices/xml', [InvoiceController::class, 'xml']);
Route::post('invoices/pdf', [InvoiceController::class, 'pdf']);

//Notes
Route::post('notes/send',[NoteController::class,'send']);
Route::post('notes/xml', [NoteController::class, 'xml']);
Route::post('notes/pdf', [NoteController::class, 'pdf']);

//Despatches
Route::post('despatches/send',[DespatchController::class,'send']);
Route::post('despatches/xml', [DespatchController::class, 'xml']);
Route::post('despatches/pdf', [DespatchController::class, 'pdf']);
