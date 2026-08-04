<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProduitController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    // Connexion : accessible uniquement si l'utilisateur n'est pas déjà connecté
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    });

    // Zone protégée : utilisateur connecté ET administrateur
    Route::middleware(['auth:admin', 'admin'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
        Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
        Route::patch('/commandes/{commande}/valider', [CommandeController::class, 'valider'])->name('commandes.valider');
        Route::patch('/commandes/{commande}/rejeter', [CommandeController::class, 'rejeter'])->name('commandes.rejeter');

        Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

        Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
        Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
        Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');

        //Route::resource('products', ProduitController::class);

        Route::get('/products', [ProduitController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProduitController::class, 'create'])->name('products.create');
        Route::post('/products', [ProduitController::class, 'store'])->name('products.store');
        Route::get('/products/{id}', [ProduitController::class, 'show'])->name('products.show');
        Route::get('/products/{id}/edit', [ProduitController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProduitController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProduitController::class, 'destroy'])->name('products.destroy');
    });
});
