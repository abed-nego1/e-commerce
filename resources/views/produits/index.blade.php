@extends('layouts.app')

@section('title', 'Nos produits')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold mb-8">Nos produits</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-10">
            @forelse ($produits as $produit)
                <div class="flex flex-col border border-gray-200 rounded-lg overflow-hidden bg-white hover:border-black transition">
                    <a href="{{ route('produits.show', $produit) }}" class="block">
                        @if ($produit->image)
                            <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                Pas d'image
                            </div>
                        @endif

                        <div class="p-4 pb-2">
                            <h2 class="font-medium text-gray-900">{{ $produit->nom }}</h2>
                            <p class="text-sm text-gray-500 mt-1">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </a>

                    <div class="px-4 pb-4 mt-auto pt-2">
                        <form action="{{ route('cart.add', $produit) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full bg-black text-white text-sm py-2 rounded-md hover:bg-gray-800 transition">
                                Commander
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 col-span-full text-center py-12">Aucun produit disponible pour le moment.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $produits->links() }}
        </div>
    </div>
@endsection
