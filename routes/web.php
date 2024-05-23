<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\DetalleIngresoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('almacen/categoria', CategoriaController::class);

Route::resource('almacen/producto', ProductoController::class);

Route::resource('compras/persona', PersonaController::class);

Route::resource('compras/ingreso', IngresoController::class);

Route::resource('venta', VentaController::class);

Route::resource('detalle-ingreso', DetalleIngresoController::class);

Route::resource('detalle-venta', DetalleVentaController::class);

