<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
    {
        /**
         * Page My Orders : liste des commandes du client connecté.
         */
        public function index()
    {
        $commandes = Commande::with('produits')
            ->withCount('produits')
            ->latest()
            ->paginate(10);

        return view('commandes.index', compact('commandes'));
    }

        /**
         * Page Order Detail : détail d'une commande.
         */
        public function show(Commande $commande)
    {
        $commande->load([
            'produits',
            'user',
        ]);

        return view('commandes.show', compact('commande'));
    }
}

