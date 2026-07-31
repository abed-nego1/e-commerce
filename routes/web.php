<?php

use App\Http\Controllers\CartController;
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

Route::get('/login', function () {
    $user = \App\Models\User::first();

    if (!$user) {
        $user = \App\Models\User::create([
            'name' => 'Moriac Test',
            'email' => 'test@glowshop.com',
            'password' => bcrypt('password'),
        ]);
    }

    \Illuminate\Support\Facades\Auth::login($user);
    return redirect('/');
})->name('login');

Route::post('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/products', function () {
    return 'Products page';
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{produit}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::middleware('auth')->group(function () {
    Route::get('/orders', function () {
        return 'My Orders page';
    });
});
