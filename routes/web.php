<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommandeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $products = [
        [
            'name' => 'Sérum Hydratant',
            'description' => 'Peau douce et lumineuse toute la journée.',
            'price' => 29.99,
            'image' => 'images/products/serum.jpg',
        ],
        [
            'name' => 'Rouge à Lèvres Velvet',
            'description' => 'Couleur intense avec une tenue longue durée.',
            'price' => 18.50,
            'image' => 'images/products/rouge-levres.jpg',
        ],
        [
            'name' => 'Crème Éclat Visage',
            'description' => 'Une texture légère pour illuminer le teint.',
            'price' => 24.90,
            'image' => 'images/products/creme-visage.jpg',
        ],
        [
            'name' => 'Gel Nettoyant Doux',
            'description' => 'Purifie la peau sans agression.',
            'price' => 16.00,
            'image' => 'images/products/gel-nettoyant.jpg',
        ],
    ];

    return view('home', compact('products'));
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{produit}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get('/dashboard', function () {
    return view('dashboard');
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
