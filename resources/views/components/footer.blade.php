<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-brand">
            <h3>GlowShop</h3>
            <p>Découvrez des cosmétiques de qualité pour révéler votre beauté au quotidien.</p>
        </div>

        <div class="footer-links">
            <h4>Liens rapides</h4>
            <a href="{{ url('/') }}">Accueil</a>

            @auth
                <a href="{{ url('/products') }}">Produits</a>
                <a href="{{ url('/orders') }}">Mes commandes</a>
                <a href="{{ url('/cart') }}">Panier</a>
            @endauth

            @guest
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Sign Up</a>
            @endguest
        </div>

        <div class="footer-contact">
            <h4>Contact</h4>
            <p>Email : mori@glowshop.com</p>
            <p>Téléphone : +229 0161682956</p>
            <p>Adresse : cotonou, Bénin</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} GlowShop. Tous droits réservés.</p>
    </div>
</footer>
