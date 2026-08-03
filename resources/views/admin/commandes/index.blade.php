@extends('layouts.admin')

@section('title', 'Commandes')
@section('page-title', 'Commandes')
@section('page-subtitle', 'Gérer, valider ou rejeter les commandes reçues')

@section('content')

    <div class="admin-card">
        <div class="admin-card__header">
            <h2 class="admin-card__title">Toutes les commandes</h2>
        </div>

        <div class="admin-card__body">

            <form method="GET" action="{{ route('admin.commandes.index') }}" class="admin-toolbar">
                <input type="text" name="q" value="{{ request('q') }}" class="admin-search"
                    placeholder="Rechercher par client ou référence...">

                <select name="statut" class="admin-select" onchange="this.form.submit()">
                    <option value="">Tous les statuts</option>
                    <option value="en_attente" {{ request('statut') === 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="validee" {{ request('statut') === 'validee' ? 'selected' : '' }}>Validée</option>
                    <option value="rejetee" {{ request('statut') === 'rejetee' ? 'selected' : '' }}>Rejetée</option>
                </select>

                <button type="submit" class="admin-btn admin-btn--ghost">Filtrer</button>
            </form>

            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Client</th>
                            <th>Statut</th>
                            <th class="admin-table__num">Total</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($commandes as $commande)
                            <tr>
                                <td class="admin-table__cell-strong admin-mono">
                                    <a href="{{ route('admin.commandes.show', $commande->id) }}">#{{ $commande->id }}</a>
                                </td>
                                <td>{{ $commande->user->name }}</td>
                                <td>
                                    @if ($commande->statut === 'en_attente')
                                        <span class="admin-badge admin-badge--pending">En attente</span>
                                    @elseif ($commande->statut === 'validee')
                                        <span class="admin-badge admin-badge--validated">Validée</span>
                                    @elseif ($commande->statut === 'rejetee')
                                        <span class="admin-badge admin-badge--rejected">Rejetée</span>
                                    @else
                                        <span class="admin-badge admin-badge--neutral">{{ $commande->statut }}</span>
                                    @endif
                                </td>
                                <td class="admin-table__num admin-mono">{{ number_format($commande->total, 0, ',', ' ') }} F
                                </td>
                                <td class="admin-text-muted">{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="{{ route('admin.commandes.show', $commande->id) }}"
                                            class="admin-btn admin-btn--ghost admin-btn--sm">Détails</a>

                                        @if ($commande->statut === 'en_attente')
                                            <form method="POST" action="{{ route('admin.commandes.valider', $commande->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="admin-btn admin-btn--success admin-btn--sm">
                                                    Valider
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('admin.commandes.rejeter', $commande->id) }}"
                                                onsubmit="return confirm('Rejeter cette commande ?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="admin-btn admin-btn--danger admin-btn--sm">
                                                    Rejeter
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="admin-empty">Aucune commande ne correspond à votre recherche.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="admin-pagination">
                {{ $commandes->links() ?? '' }}
            </div>

        </div>
    </div>

@endsection
