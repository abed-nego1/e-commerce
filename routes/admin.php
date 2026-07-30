<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    // Connexion : accessible uniquement si l'utilisateur n'est pas déjà connecté
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    });

    // Zone protégée : utilisateur connecté ET administrateur
    Route::middleware(['auth', 'admin'])->group(function () {
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
    });
});
