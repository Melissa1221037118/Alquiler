<?php

use App\Http\Controllers\api\VehiculoController;
use App\Http\Controllers\api\ClienteController;
use App\Http\Controllers\api\ContratoDeAlquilerController;
use App\Http\Controllers\api\PagoController;
use App\Http\Controllers\api\ReservaController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para Vehiculos
Route::post('/vehiculos', [VehiculoController::class, 'store'])->name('vehiculos.store');
Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');
Route::get('/vehiculos/{vehiculo}', [VehiculoController::class, 'show'])->name('vehiculos.show');
Route::put('/vehiculos/{vehiculo}', [VehiculoController::class, 'update'])->name('vehiculos.update');
Route::delete('/vehiculos/{vehiculo}', [VehiculoController::class, 'destroy'])->name('vehiculos.destroy');

// Rutas para Clientes
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

// Rutas para Contratos de Alquiler
Route::post('/contratos_de_alquiler', [ContratoDeAlquilerController::class, 'store'])->name('contratos_de_alquiler.store');
Route::get('/contratos_de_alquiler', [ContratoDeAlquilerController::class, 'index'])->name('contratos_de_alquiler.index');
Route::get('/contratos_de_alquiler/{contrato}', [ContratoDeAlquilerController::class, 'show'])->name('contratos_de_alquiler.show');
Route::put('/contratos_de_alquiler/{contrato}', [ContratoDeAlquilerController::class, 'update'])->name('contratos_de_alquiler.update');
Route::delete('/contratos_de_alquiler/{contrato}', [ContratoDeAlquilerController::class, 'destroy'])->name('contratos_de_alquiler.destroy');

// Rutas para Pagos
Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.store');
Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
Route::get('/pagos/{pago}', [PagoController::class, 'show'])->name('pagos.show');
Route::put('/pagos/{pago}', [PagoController::class, 'update'])->name('pagos.update');
Route::delete('/pagos/{pago}', [PagoController::class, 'destroy'])->name('pagos.destroy');

// Rutas para Reservas
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
Route::get('/reservas/{reserva}', [ReservaController::class, 'show'])->name('reservas.show');
Route::put('/reservas/{reserva}', [ReservaController::class, 'update'])->name('reservas.update');
Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])->name('reservas.destroy');
