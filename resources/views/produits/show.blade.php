@extends('layouts.app')

@section('title', $produit->nom)

@section('content')
    <a href="{{ route('produits.index') }}" class="text-sm text-gray-500 hover:text-gray-700 underline underline-offset-4">
        &larr; Retour aux produits
    </a>

    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            @if ($produit->image)
                <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="w-full rounded-lg">
            @else
                <div class="w-full aspect-square bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                    Pas d'image
                </div>
            @endif
        </div>

        <div>
            <h1 class="text-2xl font-semibold">{{ $produit->nom }}</h1>
            <p class="text-lg text-gray-700 mt-2">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>

            <p class="text-sm mt-4 {{ $produit->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                {{ $produit->stock > 0 ? 'En stock (' . $produit->stock . ')' : 'Rupture de stock' }}
            </p>

            @if ($produit->description)
                <p class="text-gray-600 mt-6 leading-relaxed">{{ $produit->description }}</p>
            @endif
        </div>
    </div>
@endsection
