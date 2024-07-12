<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','auth.admin'])->group(function () {
    Route::resource('products', ProductController::class)->except('show');
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth','auth.user'])->group(function () {
    Route::get('/', [StoreController::class, 'index'])->name('store');
    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::delete('/cart/delete', [CartController::class, 'deleteItem'])->name('cart.deleteItem');
    Route::get('/cart/item-count', [CartController::class, 'getItemCount'])->name('cart.itemCount');
});

require __DIR__ . '/auth.php';
