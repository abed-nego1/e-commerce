<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Connectez-vous pour valider votre commande');
        }

        return redirect()->route('cart.index')->with('success', 'Commande en cours...');
    }
}
