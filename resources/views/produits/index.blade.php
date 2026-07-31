@extends('layouts.app')

@section('title', 'Nos produits')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Nos produits</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($produits as $produit)
            <a href="{{ route('produits.show', $produit) }}"
                class="border border-gray-200 rounded-lg overflow-hidden bg-white hover:border-black transition">
                @if ($produit->image)
                    <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                        Pas d'image
                    </div>
                @endif

                <div class="p-4">
                    <h2 class="font-medium text-gray-900">{{ $produit->nom }}</h2>
                    <p class="text-sm text-gray-500 mt-1">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>
                </div>
            </a>
            <form action="{{ route('cart.add', $produit) }}" method="POST" onclick="event.stopPropagation()">
                @csrf
                <button type="submit"
                    class="w-full bg-black text-white text-sm py-2 rounded-md hover:bg-gray-800 transition">
                    Commander
                </button>
            </form>

        @empty
            <p class="text-gray-500 col-span-full text-center py-12">Aucun produit disponible pour le moment.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $produits->links() }}
    </div>
@endsection
