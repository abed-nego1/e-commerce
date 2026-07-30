<?php

use App\Http\Controllers\CommandeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

/*Route::middleware('auth')->group(function () {
    Route::get('/my-orders', [CommandeController::class, 'index'])
        ->name('commandes.index');
});*/

Route::get('/my-orders', [CommandeController::class, 'index'])
    ->name('commandes.index');

Route::get('/my-orders/{commande}', [CommandeController::class, 'show'])
    ->name('commandes.show');
