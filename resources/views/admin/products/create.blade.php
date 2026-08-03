@extends('layouts.admin')

@section('title', 'Ajouter un produit')
@section('page-title', 'Nouveau produit')
@section('page-subtitle', 'Ajouter une nouvelle référence au catalogue')

@section('content')

    <div class="admin-card">
        <div class="admin-card__header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="admin-card__title">Informations du produit</h2>
            <a href="{{ route('admin.products.index') }}" class="admin-btn admin-btn--ghost admin-btn--sm">
                ← Retour à la liste
            </a>
        </div>

        <div class="admin-card__body" style="padding: 1.5rem;">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">

                    {{-- Colonne Gauche : Infos principales --}}
                    <div>
                        {{-- Nom du produit --}}
                        <div style="margin-bottom: 1.2rem;">
                            <label for="nom" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Nom du produit <span style="color: red;">*</span></label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                                   style="width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                            @error('nom')
                                <span style="color: #d9534f; font-size: 0.85rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div style="margin-bottom: 1.2rem;">
                            <label for="description" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Description</label>
                            <textarea name="description" id="description" rows="6"
                                      style="width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">{{ old('description') }}</textarea>
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
                                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
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
                            <input type="number" step="0.01" name="prix" id="prix" value="{{ old('prix') }}" required
                                   style="width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                            @error('prix')
                                <span style="color: #d9534f; font-size: 0.85rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Stock --}}
                        <div style="margin-bottom: 1.2rem;">
                            <label for="stock" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Quantité en stock <span style="color: red;">*</span></label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" required
                                   style="width: 100%; padding: 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
                            @error('stock')
                                <span style="color: #d9534f; font-size: 0.85rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div style="margin-bottom: 1.2rem;">
                            <label for="image" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Image du produit</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                   style="width: 100%; padding: 0.4rem; border: 1px solid #ccc; border-radius: 4px;">
                            @error('image')
                                <span style="color: #d9534f; font-size: 0.85rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Statut Actif --}}
                        <div style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <input type="checkbox" name="actif" id="actif" value="1" {{ old('actif', true) ? 'checked' : '' }}>
                            <label for="actif" style="font-weight: 600; cursor: pointer;">Rendre ce produit actif</label>
                        </div>
                    </div>

                </div>

                <hr style="margin: 1.5rem 0; border: 0; border-top: 1px solid #eee;">

                {{-- Bouton de soumission --}}
                <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                    <a href="{{ route('admin.products.index') }}" class="admin-btn admin-btn--ghost">Annuler</a>
                    <button type="submit" class="admin-btn admin-btn--primary">Enregistrer le produit</button>
                </div>

            </form>
        </div>
    </div>

@endsection
