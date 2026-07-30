@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-subtitle', 'Vue d’ensemble de l’activité de la boutique')

@section('content')

    {{-- ================= STATS ================= --}}
    <div class="admin-stats">
        <div class="admin-stat-card">
            <p class="admin-stat-card__label">Commandes en attente</p>
            <p class="admin-stat-card__value admin-mono">{{ $pendingOrdersCount ?? 0 }}</p>
        </div>
        <div class="admin-stat-card">
            <p class="admin-stat-card__label">Chiffre d'affaires (30j)</p>
            <p class="admin-stat-card__value admin-mono">{{ number_format($revenue30Days ?? 0, 0, ',', ' ') }} F</p>
        </div>
        <div class="admin-stat-card">
            <p class="admin-stat-card__label">Clients</p>
            <p class="admin-stat-card__value admin-mono">{{ $customersCount ?? 0 }}</p>
        </div>
        <div class="admin-stat-card">
            <p class="admin-stat-card__label">Produits actifs</p>
            <p class="admin-stat-card__value admin-mono">{{ $activeProductsCount ?? 0 }}</p>
        </div>
    </div>

    {{-- ================= DERNIERES COMMANDES ================= --}}
    <div class="admin-card">
        <div class="admin-card__header">
            <h2 class="admin-card__title">Dernières commandes</h2>
            <a href="{{ route('admin.commandes.index') }}" class="admin-btn admin-btn--ghost admin-btn--sm">Voir tout</a>
        </div>
        <div class="admin-card__body admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Client</th>
                        <th>Statut</th>
                        <th class="admin-table__num">Total</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($recentOrders ?? []) as $commande)
                        <tr>
                            <td class="admin-table__cell-strong admin-mono">#{{ $commande->id }}</td>
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
                            <td class="admin-table__num admin-mono">{{ number_format($commande->total, 0, ',', ' ') }} F</td>
                            <td class="admin-text-muted">{{ $commande->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="admin-empty">Aucune commande pour le moment.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
