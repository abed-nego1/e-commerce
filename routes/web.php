<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommandeController;
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';

require __DIR__ . '/admin.php';

Route::get('/', [ProduitController::class, 'index'])->name('home');



Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{produit}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/checkout', [CartController::class, 'showCheckout'])->name('cart.checkout');
Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('cart.checkout.process');

Route::get('/dashboard', function () {
    return view('components.welcome-user');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/my-orders', [CommandeController::class, 'index'])
    ->name('commandes.index');

Route::get('/my-orders/{commande}', [CommandeController::class, 'show'])
    ->name('commandes.show');
});

Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
