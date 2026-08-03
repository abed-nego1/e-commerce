@extends('layouts.admin')

@section('title', 'Clients')
@section('page-title', 'Clients')
@section('page-subtitle', 'Liste des utilisateurs inscrits sur la boutique')

@section('content')

    <div class="admin-card">
        <div class="admin-card__header">
            <h2 class="admin-card__title">Tous les clients</h2>
        </div>

        <div class="admin-card__body">

            <form method="GET" action="{{ route('admin.clients.index') }}" class="admin-toolbar">
                <input type="text" name="q" value="{{ request('q') }}" class="admin-search"
                    placeholder="Rechercher par nom ou e-mail...">
                <button type="submit" class="admin-btn admin-btn--ghost">Rechercher</button>
            </form>

            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>E-mail</th>
                            <th class="admin-table__num">Commandes</th>
                            <th class="admin-table__num">Total dépensé</th>
                            <th>Inscrit le</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                            <tr>
                                <td class="admin-table__cell-strong">{{ $client->name }}</td>
                                <td class="admin-text-muted">{{ $client->email }}</td>
                                <td class="admin-table__num admin-mono">{{ $client->commandes_count ?? 0 }}</td>
                                <td class="admin-table__num admin-mono">
                                    {{ number_format($client->commandes_sum_total ?? 0, 0, ',', ' ') }} F</td>
                                <td class="admin-text-muted">{{ $client->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="admin-empty">Aucun client trouvé.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="admin-pagination">
                {{ $clients->links() ?? '' }}
            </div>

        </div>
    </div>

@endsection
