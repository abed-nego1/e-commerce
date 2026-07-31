<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index(Request $request)
    {
        $commandes = Commande::with('user')
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where(function ($sub) use ($request) {
                    $sub->where('id', 'like', '%' . $request->q . '%')
                        ->orWhereHas('user', fn($u) => $u->where('name', 'like', '%' . $request->q . '%'));
                });
            })
            ->when($request->filled('statut'), fn($query) => $query->where('statut', $request->statut))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.commandes.index', compact('commandes'));
    }

    public function show(Commande $commande)
    {
        $commande->load('user', 'produits');

        return view('admin.commandes.show', compact('commande'));
    }

    public function valider(Commande $commande)
    {
        $commande->update(['statut' => 'validee']);

        return back()->with('success', "Commande #{$commande->id} validée.");
    }

    public function rejeter(Commande $commande)
    {
        $commande->update(['statut' => 'rejetee']);

        return back()->with('success', "Commande #{$commande->id} rejetée.");
    }
}
