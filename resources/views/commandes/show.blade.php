@extends('layouts.app')

@section('title', 'Détail de la commande')

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-8">

        <a
            href="{{ route('commandes.index') }}"
            class="mb-6 inline-block font-semibold text-indigo-600"
        >
            ← Retour à mes commandes
        </a>

        <div class="mb-8">
            <h1 class="text-3xl font-bold">
                Commande #{{ $commande->id }}
            </h1>

            <p class="mt-2 text-gray-600">
                Date :
                {{ $commande->created_at->format('d/m/Y à H:i') }}
            </p>

            <p class="mt-1 text-gray-600">
                Statut :
                <strong>{{ ucfirst($commande->statut) }}</strong>
            </p>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">

            <section class="lg:col-span-2">
                <div class="overflow-hidden rounded-xl border bg-white shadow-sm">

                    <div class="border-b px-6 py-4">
                        <h2 class="text-xl font-bold">
                            Produits commandés
                        </h2>
                    </div>

                    <div class="divide-y">
                        @forelse ($commande->produits as $produit)
                            @php
                                $quantite = (int) $produit->pivot->quantite;
                                $prixUnitaire = (float) $produit->pivot->prix_unitaire;
                                $sousTotal = $quantite * $prixUnitaire;

                                $imageProduit = null;

                                if (!empty($produit->image)) {
                                    $imageProduit = str_starts_with(
                                        $produit->image,
                                        'http'
                                    )
                                        ? $produit->image
                                        : asset('storage/' . $produit->image);
                                }
                            @endphp

                            <article class="flex gap-5 p-6">

                                <div class="h-24 w-24 shrink-0 overflow-hidden rounded-lg bg-gray-100">
                                    @if ($imageProduit)
                                        <img
                                            src="{{ $imageProduit }}"
                                            alt="{{ $produit->nom }}"
                                            class="h-full w-full object-cover"
                                        >
                                    @else
                                        <div class="flex h-full items-center justify-center text-3xl">
                                            📦
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-lg font-bold">
                                        {{ $produit->nom }}
                                    </h3>

                                    @if (!empty($produit->description))
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ $produit->description }}
                                        </p>
                                    @endif

                                    <div class="mt-3 text-sm text-gray-600">
                                        <p>
                                            Quantité :
                                            <strong>{{ $quantite }}</strong>
                                        </p>

                                        <p>
                                            Prix unitaire :
                                            <strong>
                                                {{ number_format($prixUnitaire, 2, ',', ' ') }}
                                                FCFA
                                            </strong>
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500">
                                        Sous-total
                                    </p>

                                    <p class="font-bold">
                                        {{ number_format($sousTotal, 2, ',', ' ') }}
                                        FCFA
                                    </p>
                                </div>
                            </article>
                        @empty
                            <div class="p-10 text-center text-gray-500">
                                Aucun produit n’est associé à cette commande.
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <aside class="space-y-6">

                <div class="rounded-xl border bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold">
                        Client
                    </h2>

                    @if ($commande->user)
                        <p class="mt-4 font-semibold">
                            {{ $commande->user->name }}
                        </p>

                        <p class="text-sm text-gray-600">
                            {{ $commande->user->email }}
                        </p>
                    @else
                        <p class="mt-4 text-gray-500">
                            Client non renseigné
                        </p>
                    @endif
                </div>

                <div class="rounded-xl border bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold">
                        Adresse de livraison
                    </h2>

                    <p class="mt-4 whitespace-pre-line text-gray-600">
                        {{ $commande->adresse_livraison ?: 'Adresse non renseignée' }}
                    </p>
                </div>

                <div class="rounded-xl border bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold">
                        Résumé
                    </h2>

                    <div class="mt-5 flex justify-between border-t pt-4">
                        <span class="font-semibold">
                            Total
                        </span>

                        <span class="text-xl font-bold text-indigo-700">
                            {{ number_format($commande->total, 2, ',', ' ') }}
                            FCFA
                        </span>
                    </div>
                </div>

            </aside>
        </div>
    </div>
@endsection@extends('layouts.app')

@section('title', 'Détail de la commande')

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-8">

        <a
            href="{{ route('commandes.index') }}"
            class="mb-6 inline-block font-semibold text-indigo-600"
        >
            ← Retour à mes commandes
        </a>

        <div class="mb-8">
            <h1 class="text-3xl font-bold">
                Commande #{{ $commande->id }}
            </h1>

            <p class="mt-2 text-gray-600">
                Date :
                {{ $commande->created_at->format('d/m/Y à H:i') }}
            </p>

            <p class="mt-1 text-gray-600">
                Statut :
                <strong>{{ ucfirst($commande->statut) }}</strong>
            </p>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">

            <section class="lg:col-span-2">
                <div class="overflow-hidden rounded-xl border bg-white shadow-sm">

                    <div class="border-b px-6 py-4">
                        <h2 class="text-xl font-bold">
                            Produits commandés
                        </h2>
                    </div>

                    <div class="divide-y">
                        @forelse ($commande->produits as $produit)
                            @php
                                $quantite = (int) $produit->pivot->quantite;
                                $prixUnitaire = (float) $produit->pivot->prix_unitaire;
                                $sousTotal = $quantite * $prixUnitaire;

                                $imageProduit = null;

                                if (!empty($produit->image)) {
                                    $imageProduit = str_starts_with(
                                        $produit->image,
                                        'http'
                                    )
                                        ? $produit->image
                                        : asset('storage/' . $produit->image);
                                }
                            @endphp

                            <article class="flex gap-5 p-6">

                                <div class="h-24 w-24 shrink-0 overflow-hidden rounded-lg bg-gray-100">
                                    @if ($imageProduit)
                                        <img
                                            src="{{ $imageProduit }}"
                                            alt="{{ $produit->nom }}"
                                            class="h-full w-full object-cover"
                                        >
                                    @else
                                        <div class="flex h-full items-center justify-center text-3xl">
                                            📦
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-lg font-bold">
                                        {{ $produit->nom }}
                                    </h3>

                                    @if (!empty($produit->description))
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ $produit->description }}
                                        </p>
                                    @endif

                                    <div class="mt-3 text-sm text-gray-600">
                                        <p>
                                            Quantité :
                                            <strong>{{ $quantite }}</strong>
                                        </p>

                                        <p>
                                            Prix unitaire :
                                            <strong>
                                                {{ number_format($prixUnitaire, 2, ',', ' ') }}
                                                FCFA
                                            </strong>
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500">
                                        Sous-total
                                    </p>

                                    <p class="font-bold">
                                        {{ number_format($sousTotal, 2, ',', ' ') }}
                                        FCFA
                                    </p>
                                </div>
                            </article>
                        @empty
                            <div class="p-10 text-center text-gray-500">
                                Aucun produit n’est associé à cette commande.
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <aside class="space-y-6">

                <div class="rounded-xl border bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold">
                        Client
                    </h2>

                    @if ($commande->user)
                        <p class="mt-4 font-semibold">
                            {{ $commande->user->name }}
                        </p>

                        <p class="text-sm text-gray-600">
                            {{ $commande->user->email }}
                        </p>
                    @else
                        <p class="mt-4 text-gray-500">
                            Client non renseigné
                        </p>
                    @endif
                </div>

                <div class="rounded-xl border bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold">
                        Adresse de livraison
                    </h2>

                    <p class="mt-4 whitespace-pre-line text-gray-600">
                        {{ $commande->adresse_livraison ?: 'Adresse non renseignée' }}
                    </p>
                </div>

                <div class="rounded-xl border bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold">
                        Résumé
                    </h2>

                    <div class="mt-5 flex justify-between border-t pt-4">
                        <span class="font-semibold">
                            Total
                        </span>

                        <span class="text-xl font-bold text-indigo-700">
                            {{ number_format($commande->total, 2, ',', ' ') }}
                            FCFA
                        </span>
                    </div>
                </div>

            </aside>
        </div>
    </div>
@endsection