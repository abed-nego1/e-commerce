@extends('layouts.admin')

@section('title', 'Modifier le produit')
@section('page-title', 'Modifier le produit')
@section('page-subtitle', 'Mettre à jour les informations du produit #' . $produit->id)

@section('content')

    <div class="admin-card">
        <div class="admin-card__header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="admin-card__title">Éditer : {{ $produit->nom }}</h2>
            <a href="{{ route('admin.products.index') }}" class="admin-btn admin-btn--ghost admin-btn--sm">
                ← Retour à la liste
            </a>
        </div>

        <div class="admin-card__body" style="padding: 1.5rem;">
            <form action="{{ route('admin.products.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">

                    {{-- Colonne Gauche : Infos principales --}}
                    <div>
                        {{-- Nom du produit --}}
                        <div style="margin-bottom: 1.2rem;">
                            <label for="nom" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Nom du produit <span style="color: red;">*</span></label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom', $produit->nom) }}" required
                                   style="width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                            @error('nom')
                                <span style="color: #d9534f; font-size: 0.85rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div style="margin-bottom: 1.2rem;">
                            <label for="description" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Description</label>
                            <textarea name="description" id="description" rows="6"
                                      style="width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">{{ old('description', $produit->description) }}</textarea>
                            @error('description')
                                <span style="color: #d9534f; font-size: 0.85rem;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Colonne Droite : Paramètres et prix --}}
                    <div>
                        {{-- Catégorie --}}
                        <div style="margin-bottom: 1.2rem;">
                            <label for="categorie_id" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Catégorie <span style="color: red;">*</span></label>
                            <select name="categorie_id" id="categorie_id" required style="width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                                <option value="">-- Sélectionner une catégorie --</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ old('categorie_id', $produit->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie_id')
                                <span style="color: #d9534f; font-size: 0.85rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Prix --}}
                        <div style="margin-bottom: 1.2rem;">
                            <label for="prix" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Prix (F CFA) <span style="color: red;">*</span></label>
                            <input type="number" step="0.01" name="prix" id="prix" value="{{ old('prix', $produit->prix) }}" required
                                   style="width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                            @error('prix')
                                <span style="color: #d9534f; font-size: 0.85rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Stock --}}
                        <div style="margin-bottom: 1.2rem;">
                            <label for="stock" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Quantité en stock <span style="color: red;">*</span></label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $produit->stock) }}" required
                                   style="width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                            @error('stock')
                                <span style="color: #d9534f; font-size: 0.85rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Image actuelle + Nouveau Fichier --}}
                        <div style="margin-bottom: 1.2rem;">
                            <label for="image" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Image du produit</label>
                            @if($produit->image)
                                <div style="margin-bottom: 0.5rem;">
                                    <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                                    <p style="font-size: 0.75rem; color: #666; margin-top: 2px;">Image actuelle</p>
                                </div>
                            @endif
                            <input type="file" name="image" id="image" accept="image/*"
                                   style="width: 100%; padding: 0.4rem; border: 1px solid #ccc; border-radius: 4px;">
                            <small style="color: #777; font-size: 0.8rem;">Laissez vide si vous ne voulez pas modifier l'image.</small>
                            @error('image')
                                <span style="color: #d9534f; font-size: 0.85rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Statut Actif --}}
                        <div style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <input type="checkbox" name="actif" id="actif" value="1" {{ old('actif', $produit->actif) ? 'checked' : '' }}>
                            <label for="actif" style="font-weight: 600; cursor: pointer;">Rendre ce produit actif</label>
                        </div>
                    </div>

                </div>

                <hr style="margin: 1.5rem 0; border: 0; border-top: 1px solid #eee;">

                {{-- Boutons d'action --}}
                <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                    <a href="{{ route('admin.products.index') }}" class="admin-btn admin-btn--ghost">Annuler</a>
                    <button type="submit" class="admin-btn admin-btn--primary">Mettre à jour le produit</button>
                </div>

            </form>
        </div>
    </div>

@endsection
