@extends('layouts.admin')

@section('title', 'Détails du produit')
@section('page-title', 'Détails du produit')
@section('page-subtitle', 'Fiche d’information complète du produit')

@section('content')

    <div class="admin-card">
        <div class="admin-card__header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="admin-card__title">{{ $produit->nom }}</h2>
            <div style="display: flex; gap: 0.5rem;">
                <a href="{{ route('admin.products.index') }}" class="admin-btn admin-btn--ghost admin-btn--sm">
                    ← Retour
                </a>
                <a href="{{ route('admin.products.edit', $produit->id) }}" class="admin-btn admin-btn--primary admin-btn--sm">
                    ✏️ Modifier
                </a>
            </div>
        </div>

        <div class="admin-card__body" style="padding: 1.5rem;">
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">

                {{-- Aperçu de l'image --}}
                <div>
                    @if ($produit->image)
                        <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px; border: 1px solid #eee;">
                    @else
                        <div style="width: 100%; height: 200px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center; border-radius: 8px; color: #999;">
                            Aucune image disponible
                        </div>
                    @endif
                </div>

                {{-- Informations --}}
                <div>
                    <div style="margin-bottom: 1rem;">
                        <span class="admin-text-muted" style="font-size: 0.85rem; text-transform: uppercase;">Catégorie</span>
                        <p style="font-weight: 600; font-size: 1.1rem; margin: 0;">{{ $produit->categorie->nom ?? 'Non assignée' }}</p>
                    </div>

                    <div style="margin-bottom: 1rem; display: flex; gap: 2rem;">
                        <div>
                            <span class="admin-text-muted" style="font-size: 0.85rem; text-transform: uppercase;">Prix</span>
                            <p class="admin-mono" style="font-weight: bold; font-size: 1.3rem; margin: 0; color: #2c3e50;">
                                {{ number_format($produit->prix, 0, ',', ' ') }} F CFA
                            </p>
                        </div>

                        <div>
                            <span class="admin-text-muted" style="font-size: 0.85rem; text-transform: uppercase;">Stock</span>
                            <p class="admin-mono" style="font-weight: bold; font-size: 1.3rem; margin: 0;">
                                {{ $produit->stock }} unité(s)
                            </p>
                        </div>

                        <div>
                            <span class="admin-text-muted" style="font-size: 0.85rem; text-transform: uppercase;">Statut</span>
                            <p style="margin: 0;">
                                @if ($produit->actif)
                                    <span class="admin-badge admin-badge--validated">Actif</span>
                                @else
                                    <span class="admin-badge admin-badge--rejected">Inactif</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <span class="admin-text-muted" style="font-size: 0.85rem; text-transform: uppercase;">Slug</span>
                        <p class="admin-mono" style="background: #f8f9fa; padding: 0.4rem; border-radius: 4px; font-size: 0.9rem;">
                            {{ $produit->slug }}
                        </p>
                    </div>

                    <div>
                        <span class="admin-text-muted" style="font-size: 0.85rem; text-transform: uppercase;">Description</span>
                        <p style="margin-top: 0.5rem; line-height: 1.5; color: #444;">
                            {{ $produit->description ?? 'Aucune description rédigée pour ce produit.' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
