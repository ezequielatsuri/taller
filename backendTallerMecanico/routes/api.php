<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FabricanteController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PagoClienteController;
use App\Http\Controllers\PagoProvedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProvedorController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\VentaProductoController;
use App\Http\Controllers\VentaServicioController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Rutas de Categorías
Route::apiResource('/categorias', CategoriaController::class)->names('categorias');

// Rutas de Clientes
Route::apiResource('/clientes', ClienteController::class)->names('clientes');

// Rutas de Fabricantes
Route::apiResource('/fabricantes', FabricanteController::class)->names('fabricantes');

// Rutas de pago
Route::apiResource('/pagos', PagoController::class)->names('pagos');

// Rutas de Pagos de Clientes
Route::apiResource('/pagos-clientes', PagoClienteController::class)->names('pagos-clientes');

// Rutas de Pagos a Proveedores
Route::apiResource('/pagos-provedores', PagoProvedorController::class)->names('pagos-provedores');

// Rutas de Productos
Route::apiResource('/productos', ProductoController::class)->names('productos');

// Rutas de Personas
Route::apiResource('/personas', PersonaController::class)->names('personas');

// Rutas de Proveedores
Route::apiResource('/provedores', ProvedorController::class)->names('provedores');

// Rutas de Tareas
Route::apiResource('/tareas', TareaController::class)->names('tareas');

// Rutas de Vehículos
Route::apiResource('/vehiculos', VehiculoController::class)->names('vehiculos');

// Rutas de Ventas
Route::apiResource('/ventas', VentaController::class)->names('ventas');

// Rutas de Venta Productos
Route::apiResource('/venta-productos', VentaProductoController::class)->names('venta-productos');

// Rutas de Venta Servicios
Route::apiResource('/venta-servicios', VentaServicioController::class)->names('venta-servicios');
