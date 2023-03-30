<?php

use App\Http\Controllers\CarritoControler;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasControler;
use App\Http\Controllers\LibreriaControler;
use App\Http\Controllers\LibrosControler;
use App\Http\Controllers\PruebaControler;
use App\Http\Controllers\UserControler;
use App\Http\Controllers\pagoControler;

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

Route::get('/dashboard', [LibreriaControler::class, 'index'], function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//menu
Route::get('/', [LibreriaControler::class, 'index']);
Route::get('/verLibros', [LibrosControler::class, 'ver']);
Route::get('/verCategorias', [CategoriasControler::class, 'ver']);
Route::get('/guardarLibro', [LibrosControler::class, 'guardar']);
Route::get('/guardarCategoria', [CategoriasControler::class, 'guardar']);
Route::get('/guardarUsuario', [UserControler::class, 'guardar']);
//crud categorias
Route::post('/upCategoria', [CategoriasControler::class, 'guardarCategoria']);
Route::post('/updateCategoria', [CategoriasControler::class, 'updateCategoria']);
Route::post('/deleteCategoria', [CategoriasControler::class, 'deleteCategoria']);
//crud libros
Route::get('/catLibros', [LibrosControler::class, 'catLibros']);
Route::post('/upLibro', [LibrosControler::class, 'upLibro']);
Route::post('/updateLibro', [LibrosControler::class, 'updateLibro']);
Route::post('/deleteLibro', [LibrosControler::class, 'deleteLibro']);
//crud usuarios
Route::post('/upUser', [UserControler::class, 'upUser']);
Route::post('/updateUser', [UserControler::class, 'updateUser']);
Route::post('/deleteUser', [UserControler::class, 'deleteUser']);
//accesos restringidos
Route::get('/noPasar', [PruebaControler::class, 'prueba']);
//gestion carrito
Route::get('/carrito', [CarritoControler::class, 'upCarrito']);
Route::get('/borrarItem', [CarritoControler::class, 'borrarItem']);
Route::get('/verCarrito', [CarritoControler::class, 'ver']);
//pagos
Route::get('/pagar', [pagoControler::class, 'pagar']);
Route::post('/createCharge', [pagoControler::class, 'charge']);
//ruta para pruebas
Route::get('/view3', [PruebaControler::class, 'probar']);
//estrellas libros
Route::get('/valorarLibro', [LibrosControler::class, 'valorarLibro']);
Route::post('/valoracion', [LibrosControler::class, 'valoracion']);