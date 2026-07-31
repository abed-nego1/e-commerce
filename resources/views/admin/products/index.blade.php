@extends('layouts.admin')

@section('title', 'Gestion des produits')
@section('page-title', 'Produits')
@section('page-subtitle', 'Liste et gestion de tous les produits de la boutique')

@section('content')

    {{-- Message de succès après création / modification / suppression --}}
    @if (session('success'))
        <div class="admin-alert admin-alert--success" style="margin-bottom: 1.5rem; padding: 1rem; background-color: #d1e7dd; color: #0f5132; border-radius: 6px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-card">
        <div class="admin-card__header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="admin-card__title">Tous les produits</h2>
            <a href="{{ route('admin.products.create') }}" class="admin-btn admin-btn--primary">
                + Ajouter un produit
            </a>
        </div>

        <div class="admin-card__body admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th class="admin-table__num">Prix</th>
                        <th class="admin-table__num">Stock</th>
                        <th>Statut</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produits as $produit)
                        <tr>
                            <td>
                                @if ($produit->image)
                                    <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <span class="admin-text-muted" style="font-size: 0.8rem;">Pas d'img</span>
                                @endif
                            </td>
                            <td class="admin-table__cell-strong">{{ $produit->nom }}</td>
                            <td>{{ $produit->categorie->nom ?? 'Non assignée' }}</td>
                            <td class="admin-table__num admin-mono">{{ number_format($produit->prix, 0, ',', ' ') }} F</td>
                            <td class="admin-table__num admin-mono">
                                @if ($produit->stock <= 5)
                                    <span style="color: #d9534f; font-weight: bold;">{{ $produit->stock }}</span>
                                @else
                                    {{ $produit->stock }}
                                @endif
                            </td>
                            <td>
                                @if ($produit->actif)
                                    <span class="admin-badge admin-badge--validated">Actif</span>
                                @else
                                    <span class="admin-badge admin-badge--rejected">Inactif</span>
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.products.edit', $produit->id) }}" class="admin-btn admin-btn--ghost admin-btn--sm">
                                    Modifier
                                </a>

                                <form action="{{ route('admin.products.destroy', $produit->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Es-tu sûr de vouloir supprimer ce produit ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn admin-btn--danger admin-btn--sm">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="admin-empty">Aucun produit n'a été trouvé.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Laravel --}}
        @if ($produits->hasPages())
            <div class="admin-card__footer" style="padding: 1rem;">
                {{ $produits->links() }}
            </div>
        @endif
    </div>

@endsection
