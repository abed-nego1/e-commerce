<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'E-commerce')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50 text-gray-900">
    <header class="border-b bg-white shadow-sm">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="/" class="text-xl font-bold text-indigo-700">
                E-commerce
            </a>

            <nav class="flex items-center gap-5">
                <a
                    href="{{ route('commandes.index') }}"
                    class="font-medium text-gray-700 hover:text-indigo-700"
                >
                    Mes commandes
                </a>

                @auth
                    <span class="text-sm text-gray-500">
                        {{ auth()->user()->name }}
                    </span>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8">
        @yield('content')
    </main>
</body>
</html>