<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion · Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap"
        rel="stylesheet">
    @vite('resources/css/admin.css')
</head>

<body class="admin-body">

    <div class="admin-auth-page">
        <div class="admin-auth-card">
            <div class="admin-auth-card__brand">
                <span class="admin-sidebar__brand-mark">SB</span>
                <span class="admin-auth-card__title" style="margin:0;">Shop Admin</span>
            </div>

            <h2 class="admin-auth-card__title">Connexion</h2>
            <p class="admin-auth-card__subtitle">Accès réservé aux administrateurs.</p>

            @if ($errors->any())
                <div class="admin-flash admin-flash--error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.attempt') }}" class="admin-auth-form">
                @csrf

                <div class="admin-form__group">
                    <label for="email" class="admin-form__label">Adresse e-mail</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="admin-form__input"
                        placeholder="admin@boutique.com" required autofocus>
                </div>

                <div class="admin-form__group">
                    <label for="password" class="admin-form__label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="admin-form__input"
                        placeholder="••••••••" required>
                </div>

                <button type="submit" class="admin-btn admin-btn--primary admin-auth-card__submit">
                    Se connecter
                </button>
            </form>
        </div>
    </div>

</body>

</html>
