<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commande;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private function getCartQuery()
    {
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id());
        }

        return CartItem::where('session_id', session()->getId());
    }

    private function getCartData()
    {
        if (Auth::check()) {
            return ['user_id' => Auth::id(), 'session_id' => null];
        }

        return ['user_id' => null, 'session_id' => session()->getId()];
    }

    public function index()
    {
        $cartItems = $this->getCartQuery()->with('produit')->get();

        $total = $cartItems->sum(function ($item) {
            return $item->produit->prix * $item->quantity;
        });

        return view('cart', compact('cartItems', 'total'));
    }

    public function add(Produit $produit)
    {
        $data = $this->getCartData();

        $cartItem = CartItem::where($data)
            ->where('produit_id', $produit->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create(array_merge($data, [
                'produit_id' => $produit->id,
                'quantity' => 1,
            ]));
        }

        return redirect()->back()->with('success', 'Produit ajouté au panier');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = $this->getCartQuery()->findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        $cartItem = $this->getCartQuery()->findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier');
    }

    public function clear()
    {
        $this->getCartQuery()->delete();

        return redirect()->route('cart.index')->with('success', 'Panier vidé');
    }

    // Affiche le formulaire d'adresse avant de valider la commande
    public function showCheckout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('info', 'Connectez-vous pour valider votre commande');
        }

        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('produit')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->produit->prix * $item->quantity;
        });

        return view('cart.checkout', compact('cartItems', 'total'));
    }

    // Traite le formulaire d'adresse et crée réellement la commande
    public function processCheckout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('info', 'Connectez-vous pour valider votre commande');
        }

        $validated = $request->validate([
            'rue' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:20',
            'pays' => 'required|string|max:255',
        ]);

        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('produit')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        DB::transaction(function () use ($cartItems, $validated) {

            $total = $cartItems->sum(function ($item) {
                return $item->produit->prix * $item->quantity;
            });

            $commande = Commande::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'statut' => 'en_attente',
                'adresse_livraison' => $validated,
            ]);

            foreach ($cartItems as $item) {
                $commande->produits()->attach($item->produit_id, [
                    'quantite' => $item->quantity,
                    'prix_unitaire' => $item->produit->prix,
                ]);
            }

            CartItem::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('commandes.index')
            ->with('success', 'Commande passée avec succès.');
    }
}
