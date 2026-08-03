@extends('layouts.app')

@section('title', 'Mes commandes')

@section('content')
    <div class="mb-8">
        <p class="mb-2 text-sm font-semibold uppercase tracking-wide text-indigo-600">
            Mon compte
        </p>

        <h1 class="text-3xl font-bold text-gray-900">
            Mes commandes
        </h1>

        <p class="mt-2 text-gray-600">
            Retrouvez l'historique et le statut de vos commandes.
        </p>
    </div>

    @forelse ($commandes as $commande)
        @php
            $statutClasse = match ($commande->statut) {
                'livree' => 'bg-green-100 text-green-700',
                'expediee' => 'bg-purple-100 text-purple-700',
                'en_cours' => 'bg-blue-100 text-blue-700',
                'annulee' => 'bg-red-100 text-red-700',
                default => 'bg-amber-100 text-amber-700',
            };

            $statutLibelle = match ($commande->statut) {
                'livree' => 'Livrée',
                'expediee' => 'Expédiée',
                'en_cours' => 'En cours',
                'annulee' => 'Annulée',
                default => 'En attente',
            };
        @endphp

        <article class="mb-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col justify-between gap-5 md:flex-row md:items-center">
                <div>
                    <div class="mb-3 flex flex-wrap items-center gap-3">
                        <h2 class="text-lg font-bold text-gray-900">
                            Commande #{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}
                        </h2>

                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statutClasse }}">
                            {{ $statutLibelle }}
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-gray-600">
                        <p>
                            <span class="font-medium text-gray-800">Date :</span>
                            {{ $commande->created_at->format('d/m/Y à H:i') }}
                        </p>

                        <p>
                            <span class="font-medium text-gray-800">Articles :</span>
                            {{ $commande->produits_count }}
                        </p>

                        <p>
                            <span class="font-medium text-gray-800">Total :</span>
                            {{ number_format($commande->total, 2, ',', ' ') }} €
                        </p>
                    </div>
                </div>

                <a
                    href="{{ route('commandes.show', $commande) }}"
                    class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700"
                >
                    Voir le détail
                </a>
            </div>

            <div class="mt-5 border-t border-gray-200 pt-5">
                <h3 class="mb-4 font-semibold text-gray-900">
                    Produits commandés
                </h3>

                <div class="space-y-4">
                    @forelse ($commande->produits as $produit)
                        @php
                            $imageProduit = null;

                            if ($produit->image) {
                                $imageProduit = str_starts_with($produit->image, 'http')
                                    ? $produit->image
                                    : asset('storage/' . $produit->image);
                            }
                        @endphp

                        <div class="flex items-center gap-4 rounded-xl bg-gray-50 p-4">
                            <div class="h-20 w-20 shrink-0 overflow-hidden rounded-lg bg-gray-200">
                                @if ($imageProduit)
                                    <img
                                        src="{{ $imageProduit }}"
                                        alt="{{ $produit->nom }}"
                                        class="h-full w-full object-cover"
                                    >
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-2xl">
                                        📦
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">
                                    {{ $produit->nom }}
                                </h4>

                                <p class="mt-1 text-sm text-gray-600">
                                    Quantité : {{ $produit->pivot->quantite }}
                                </p>

                                <p class="text-sm text-gray-600">
                                    Prix unitaire :
                                    {{ number_format($produit->pivot->prix_unitaire, 2, ',', ' ') }} €
                                </p>
                            </div>

                            <p class="font-bold text-gray-900">
                                {{
                                    number_format(
                                        $produit->pivot->quantite * $produit->pivot->prix_unitaire,
                                        2,
                                        ',',
                                        ' '
                                    )
                                }} €
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">
                            Aucun produit associé à cette commande.
                        </p>
                    @endforelse
                </div>
            </div>
        </article>
    @empty
        <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">
            <div class="mb-4 text-5xl">🛍️</div>

            <h2 class="text-xl font-bold text-gray-900">
                Aucune commande
            </h2>

            <p class="mt-2 text-gray-600">
                Vous n'avez pas encore effectué de commande.
            </p>

            <a
                href="/"
                class="mt-6 inline-flex rounded-lg bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-700"
            >
                Découvrir les produits
            </a>
        </div>
    @endforelse

    <div class="mt-8">
        {{ $commandes->links() }}
    </div>
@endsection
