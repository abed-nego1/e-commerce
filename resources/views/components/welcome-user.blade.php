<section class="welcome-user">
    <div class="welcome-content">
        <span class="welcome-tag">Bon retour parmi nous</span>
        <h1>Bienvenue {{ Auth::user()->name ?? 'chez vous' }} ✨</h1>
        <p>Découvrez nos nouveautés et vos coups de cœur du moment.</p>

        <div class="welcome-actions">
            <a href="{{ url('/products') }}" class="btn-primary">Voir tous les produits</a>
            <a href="{{ url('/cart') }}" class="btn-secondary">Mon panier</a>
        </div>
    </div>

    <div class="welcome-stats">
        <div class="stat-card">
            <i class="fa-solid fa-bag-shopping"></i>
            <span class="stat-value">{{ Auth::user()->cartItems()->sum('quantity') }}</span>
            <span class="stat-label">Articles dans le panier</span>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-heart"></i>
            <span class="stat-value">12</span>
            <span class="stat-label">Nouveautés</span>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-gift"></i>
            <span class="stat-value">-20%</span>
            <span class="stat-label">Offre membre</span>
        </div>
    </div>
</section>
