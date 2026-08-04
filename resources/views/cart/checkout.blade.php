@extends('layouts.app')

@section('title', 'Finaliser ma commande - GlowShop')

@section('content')
    <section class="cart-page">
        <div class="cart-header">
            <span class="section-tag">Dernière étape</span>
            <h1>Adresse de livraison</h1>
            <p>Indiquez où vous souhaitez recevoir votre commande.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="cart-container">
            <div class="cart-items">
                <form method="POST" action="{{ route('cart.checkout.process') }}">
                    @csrf

                    <div class="mb-3">
                        <label>Rue</label>
                        <input type="text" name="rue" value="{{ old('rue') }}" class="qty-input" style="width:100%;"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Ville</label>
                        <input type="text" name="ville" value="{{ old('ville') }}" class="qty-input" style="width:100%;"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Code postal</label>
                        <input type="text" name="code_postal" value="{{ old('code_postal') }}" class="qty-input"
                            style="width:100%;" required>
                    </div>

                    <div class="mb-3">
                        <label>Pays</label>
                        <input type="text" name="pays" value="{{ old('pays') }}" class="qty-input" style="width:100%;"
                            required>
                    </div>

                    <button type="submit" class="btn-primary checkout-btn">Valider la commande</button>
                </form>
            </div>

            <aside class="cart-summary">
                <h2>Résumé</h2>

                @foreach ($cartItems as $item)
                    <div class="summary-line">
                        <span>{{ $item->produit->nom }} × {{ $item->quantity }}</span>
                        <span>{{ number_format($item->produit->prix * $item->quantity, 2, ',', ' ') }} €</span>
                    </div>
                @endforeach

                <div class="summary-total">
                    <span>Total</span>
                    <span>{{ number_format($total, 2, ',', ' ') }} €</span>
                </div>
            </aside>
        </div>
    </section>
@endsection
