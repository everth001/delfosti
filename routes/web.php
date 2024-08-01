<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('pedido', [App\Http\Controllers\PedidoController::class, 'view'])->name('view.pedido');
	Route::get('pedido/listar', [App\Http\Controllers\PedidoController::class, 'index'])->name('listar.pedido');
	Route::post('pedido/buscar_pedido/{pedido}', [App\Http\Controllers\PedidoController::class, 'show'])->name('buscar.pedido');

	Route::get('producto/listar', [App\Http\Controllers\ProductoController::class, 'index'])->name('listar.producto');
	
	Route::get('estado/listar', [App\Http\Controllers\EstadoController::class, 'index'])->name('listar.estado');
	
	Route::post('pedido/crear', [App\Http\Controllers\PedidoController::class, 'create'])->name('crear.pedido');
	Route::post('pedido/update/{pedido}', [App\Http\Controllers\PedidoController::class, 'update'])->name('update.pedido');

	Route::get('trazabilidadPedido/buscar_trazabilidad', [App\Http\Controllers\TrazabilidadPedidoController::class, 'show'])->name('buscar.trazabilidadPedido');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
});