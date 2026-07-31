<header class="site-header">
    <nav class="navbar">
        <a href="{{ url('/') }}" class="logo">GlowShop</a>

        <div class="nav-right">
            <a href="{{ url('/produits') }}" class="nav-link">Products</a>

            @auth
                <a href="{{ url('/my-orders') }}" class="nav-link">My Orders</a>
            @endauth

            <a href="{{ url('/cart') }}" class="cart-link">
                <i class="fa-solid fa-bag-shopping"></i>
                {{-- <span class="cart-badge">
                    @if (Auth::check())
                        {{ \App\Models\CartItem::where('user_id', Auth::id())->sum('quantity') }}
                    @else
                        {{ \App\Models\CartItem::where('session_id', session()->getId())->sum('quantity') }}
                    @endif
                </span> --}}
            </a>

            @guest
                <a href="{{ url('/login') }}" class="nav-link">Login</a>
                <a href="{{ url('/register') }}" class="nav-btn">Sign Up</a>
            @endguest

            @auth
                <form method="POST" action="{{ url('/logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="nav-link logout-btn">Logout</button>
                </form>
            @endauth
        </div>
    </nav>
</header>
