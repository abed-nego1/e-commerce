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
        @foreach ($commande->produits as $produit)
            <tr>
                <td>{{ $produit->nom }}</td>
                <td class="admin-table__num admin-mono">{{ number_format($produit->pivot->prix_unitaire, 0, ',', ' ') }} F</td>
                <td class="admin-table__num admin-mono">{{ $produit->pivot->quantite }}</td>
                <td class="admin-table__num admin-mono">{{ number_format($produit->pivot->prix_unitaire * $produit->pivot->quantite, 0, ',', ' ') }} F</td>
            </tr>
        @endforeach
    </tbody>
    ...
