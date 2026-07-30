<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') · E-commerce Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap"
        rel="stylesheet">
    @vite('resources/css/admin.css')
    @stack('styles')
</head>

<body class="admin-body">

    <div class="admin-shell">

        {{-- ================= SIDEBAR ================= --}}
        <aside class="admin-sidebar">
            <div class="admin-sidebar__brand">
                <span class="admin-sidebar__brand-mark">SB</span>
                <span class="admin-sidebar__brand-name">Shop Admin</span>
            </div>

            <ul class="admin-nav">
                <li class="admin-nav__item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="admin-nav__link {{ request()->routeIs('admin.dashboard') ? 'admin-nav__link--active' : '' }}">
                        <span class="admin-nav__icon">&#9632;</span> Tableau de bord
                    </a>
                </li>
                <li class="admin-nav__item">
                    <a href="{{ route('admin.commandes.index') }}"
                        class="admin-nav__link {{ request()->routeIs('admin.commandes.*') ? 'admin-nav__link--active' : '' }}">
                        <span class="admin-nav__icon">&#128230;</span> Commandes
                    </a>
                </li>
                <li class="admin-nav__item">
                    <a href="{{ route('admin.clients.index') }}"
                        class="admin-nav__link {{ request()->routeIs('admin.clients.*') ? 'admin-nav__link--active' : '' }}">
                        <span class="admin-nav__icon">&#128100;</span> Clients
                    </a>
                </li>
                <li class="admin-nav__item">
                    <a href="{{ route('admin.admins.index') }}"
                        class="admin-nav__link {{ request()->routeIs('admin.admins.*') ? 'admin-nav__link--active' : '' }}">
                        <span class="admin-nav__icon">&#128274;</span> Administrateurs
                    </a>
                </li>
            </ul>

            <div class="admin-sidebar__footer">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="admin-sidebar__logout">Se déconnecter</button>
                </form>
            </div>
        </aside>

        {{-- ================= COLONNE PRINCIPALE ================= --}}
        <div class="admin-main">

            <header class="admin-topbar">
                <div class="admin-topbar__heading">
                    <h1 class="admin-topbar__title">@yield('page-title', 'Tableau de bord')</h1>
                    @hasSection('page-subtitle')
                        <p class="admin-topbar__subtitle">@yield('page-subtitle')</p>
                    @endif
                </div>
                <div class="admin-topbar__right">
                    <div class="admin-topbar__user">
                        <span
                            class="admin-topbar__avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                        <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                    </div>
                </div>
            </header>

            <main class="admin-content">
                @if (session('success'))
                    <div class="admin-flash admin-flash--success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="admin-flash admin-flash--error">{{ session('error') }}</div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
