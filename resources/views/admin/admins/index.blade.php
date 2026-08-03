@extends('layouts.admin')

@section('title', 'Administrateurs')
@section('page-title', 'Administrateurs')
@section('page-subtitle', 'Gérer les comptes ayant accès au back-office')

@section('content')

    <div class="admin-card">
        <div class="admin-card__header">
            <h2 class="admin-card__title">Ajouter un administrateur</h2>
        </div>
        <div class="admin-card__body">
            <form method="POST" action="{{ route('admin.admins.store') }}" class="admin-form">
                @csrf

                <div class="admin-form__group">
                    <label for="name" class="admin-form__label">Nom complet</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="admin-form__input"
                        placeholder="Ex : Chloé Nguyen" required>
                    @error('name')
                    <p class="admin-form__error">{{ $message }}</p> @enderror
                </div>

                <div class="admin-form__group">
                    <label for="email" class="admin-form__label">Adresse e-mail</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="admin-form__input"
                        placeholder="admin@boutique.com" required>
                    @error('email')
                    <p class="admin-form__error">{{ $message }}</p> @enderror
                </div>

                <div class="admin-form__group">
                    <label for="password" class="admin-form__label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="admin-form__input" placeholder="••••••••"
                        required>
                    @error('password')
                    <p class="admin-form__error">{{ $message }}</p> @enderror
                    <p class="admin-form__hint">8 caractères minimum.</p>
                </div>

                <button type="submit" class="admin-btn admin-btn--primary">Créer l'administrateur</button>
            </form>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card__header">
            <h2 class="admin-card__title">Administrateurs actuels</h2>
        </div>
        <div class="admin-card__body admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Ajouté le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr>
                            <td class="admin-table__cell-strong">{{ $admin->name }}</td>
                            <td class="admin-text-muted">{{ $admin->email }}</td>
                            <td class="admin-text-muted">{{ $admin->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if ($admin->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.admins.destroy', $admin->id) }}"
                                        onsubmit="return confirm('Supprimer cet administrateur ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn admin-btn--danger admin-btn--sm">Supprimer</button>
                                    </form>
                                @else
                                    <span class="admin-badge admin-badge--neutral">Vous</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="admin-empty">Aucun administrateur enregistré.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
