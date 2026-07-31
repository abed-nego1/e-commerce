@extends('layouts.app')

@section('title', 'Mon Panier - GlowShop')

@section('content')
<section class="cart-page">
    <div class="cart-header">
        <span class="section-tag">Votre panier</span>
        <h1>Mon Panier</h1>
        <p>Retrouvez ici les produits que vous avez sélectionnés.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    @if ($cartItems->isEmpty())
        <div class="cart-empty">
            <i class="fa-solid fa-bag-shopping"></i>
            <h2>Votre panier est vide</h2>
            <p>Découvrez nos produits et ajoutez vos coups de cœur.</p>
            <a href="{{ url('/produits') }}" class="btn-primary">Voir les produits</a>
        </div>
    @else
        <div class="cart-container">
            <div class="cart-items">
                @foreach ($cartItems as $item)
                    <div class="cart-item">
                        <div class="cart-item-image">
                            <img src="{{ asset($item->produit->image) }}" alt="{{ $item->produit->nom }}">
                        </div>

                        <div class="cart-item-info">
                            <h3>{{ $item->produit->nom }}</h3>
                            <p>{{ $item->produit->description }}</p>
                            <span class="cart-item-price">{{ number_format($item->produit->prix, 2, ',', ' ') }} €</span>
                        </div>

                        <div class="cart-item-actions">
                            <form method="POST" action="{{ route('cart.update', $item->id) }}" class="quantity-form">
                                @csrf
                                @method('PUT')
                                <button type="button" class="qty-btn" onclick="this.nextElementSibling.stepDown(); this.parentElement.submit();">-</button>
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="qty-input">
                                <button type="button" class="qty-btn" onclick="this.previousElementSibling.stepUp(); this.parentElement.submit();">+</button>
                            </form>

                            <div class="cart-item-total">
                                {{ number_format($item->produit->prix * $item->quantity, 2, ',', ' ') }} €
                            </div>

                            <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-btn">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <aside class="cart-summary">
                <h2>Résumé</h2>

                <div class="summary-line">
                    <span>Sous-total</span>
                    <span>{{ number_format($total, 2, ',', ' ') }} €</span>
                </div>

                <div class="summary-line">
                    <span>Livraison</span>
                    <span>Gratuite</span>
                </div>

                <div class="summary-total">
                    <span>Total</span>
                    <span>{{ number_format($total, 2, ',', ' ') }} €</span>
                </div>

                <form method="POST" action="{{ route('cart.checkout') }}">
                    @csrf
                    <button type="submit" class="btn-primary checkout-btn">
                        @auth
                            Passer la commande
                        @endauth
                        @guest
                            Se connecter pour commander
                        @endguest
                    </button>
                </form>

                <form method="POST" action="{{ route('cart.clear') }}" class="clear-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="clear-btn">Vider le panier</button>
                </form>
            </aside>
        </div>
    @endif
</section>
@endsection
