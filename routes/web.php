<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('detail');

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
});

Route::middleware('auth')->group(function(){
    Route::get('/cart', [HomeController::class, 'cart'])->name('cart.index');
    Route::delete('/cart/{id}', [HomeController::class, 'cartDestroy'])->name('cart.destroy');
    Route::post('/cart', CartController::class)->name('cart.store');
    Route::post('/checkout', CheckoutController::class)->name('checkout');
    Route::get('/transaction', [HomeController::class, 'transaction'])->name('transaction.index');
    Route::get('/transaction/{id}', [HomeController::class, 'transactionDetail'])->name('transaction.detail');
});