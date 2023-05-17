<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;

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
    return redirect('/sells/create');
});


//usuario
Route::get('/usuario',                [UserController::class, 'index'])->name('admin.usuario.index')  ;
Route::get('/usuario/create',         [UserController::class, 'create'])->name('admin.usuario.create') ;
Route::post('/usuario/store',         [UserController::class, 'store']) ->name('admin.usuario.store') ;

Route::get('/products',                [ProductController::class, 'index'])  ->name('admin.product.index') ;
Route::get('/products/create',         [ProductController::class, 'create'])->name('admin.product.create') ;
Route::post('/products/store',         [ProductController::class, 'store'])->name('admin.product.store') ;

Route::get('/sells',                [SellController::class, 'index'])  ->name('admin.sell.index') ;
Route::get('/sells/create',         [SellController::class, 'create'])->name('admin.sell.create') ;
Route::get('/sells/show/{id}',      [SellController::class, 'show'])->name('admin.sell.show')   ;
Route::post('/sells/store',         [SellController::class, 'store'])->name('admin.sell.store') ;


//ajax index