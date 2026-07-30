@extends('layouts.admin')

@section('title', 'Commande #' . $commande->id)
@section('page-title', 'Commande #' . $commande->id)
@section('page-subtitle', 'Passée le ' . $commande->created_at->format('d/m/Y à H:i'))

@section('content')

    <a href="{{ route('admin.commandes.index') }}" class="admin-btn admin-btn--ghost admin-btn--sm"
        style="margin-bottom:16px;">
        &larr; Retour aux commandes
    </a>

    <div class="admin-card">
        <div class="admin-card__header">
            <h2 class="admin-card__title">Statut de la commande</h2>
            @if ($commande->statut === 'en_attente')
                <span class="admin-badge admin-badge--pending">En attente</span>
            @elseif ($commande->statut === 'validee')
                <span class="admin-badge admin-badge--validated">Validée</span>
            @elseif ($commande->statut === 'rejetee')
                <span class="admin-badge admin-badge--rejected">Rejetée</span>
            @endif
        </div>

        @if ($commande->statut === 'en_attente')
            <div class="admin-card__body">
                <div class="admin-actions">
                    <form method="POST" action="{{ route('admin.commandes.valider', $commande->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="admin-btn admin-btn--success">Valider la commande</button>
                    </form>

                    <form method="POST" action="{{ route('admin.commandes.rejeter', $commande->id) }}"
                        onsubmit="return confirm('Rejeter cette commande ?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="admin-btn admin-btn--danger">Rejeter la commande</button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <div class="admin-card">
        <div class="admin-card__header">
            <h2 class="admin-card__title">Client</h2>
        </div>
        <div class="admin-card__body">
            <p><strong>{{ $commande->user->name }}</strong></p>
            <p class="admin-text-muted">{{ $commande->user->email }}</p>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card__header">
            <h2 class="admin-card__title">Adresse de livraison</h2>
        </div>
        <div class="admin-card__body">
            @php $adresse = $commande->adresse_livraison; @endphp
            <p>{{ $adresse['rue'] ?? '' }}</p>
            <p>{{ $adresse['ville'] ?? '' }} {{ $adresse['code_postal'] ?? '' }}</p>
            <p>{{ $adresse['pays'] ?? '' }}</p>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card__header">
            <h2 class="admin-card__title">Articles commandés</h2>
        </div>
        <div class="admin-card__body admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th class="admin-table__num">Prix unitaire</th>
                        <th class="admin-table__num">Quantité</th>
                        <th class="admin-table__num">Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commande->lignesCommande as $ligne)
                        <tr>
                            <td>{{ $ligne->produit->nom }}</td>
                            <td class="admin-table__num admin-mono">{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} F
                            </td>
                            <td class="admin-table__num admin-mono">{{ $ligne->quantite }}</td>
                            <td class="admin-table__num admin-mono">
                                {{ number_format($ligne->prix_unitaire * $ligne->quantite, 0, ',', ' ') }} F</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="admin-table__num admin-table__cell-strong">Total</td>
                        <td class="admin-table__num admin-table__cell-strong admin-mono">
                            {{ number_format($commande->total, 0, ',', ' ') }} F</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection
