<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function() {
    return redirect('/home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/clientes', [App\Http\Controllers\ClientesController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [App\Http\Controllers\ClientesController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [App\Http\Controllers\ClientesController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}', [App\Http\Controllers\ClientesController::class, 'show'])->name('clientes.show');
    Route::get('/clientes/{cliente}/edit', [App\Http\Controllers\ClientesController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{cliente}', [App\Http\Controllers\ClientesController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{cliente}', [App\Http\Controllers\ClientesController::class, 'destroy'])->name('clientes.destroy');

    Route::resource('productos', App\Http\Controllers\ProductoController::class);
    Route::resource('empleados', App\Http\Controllers\EmpleadoController::class);
    Route::resource('categorias', App\Http\Controllers\CategoriaController::class);
    Route::resource('pedidos', App\Http\Controllers\PedidoController::class);
});
