<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://bunny.net">
    <link href="https://bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-50 m-0 p-0">
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-12">

        <!-- CÔTÉ DROIT : Visuel Professionnel (Masqué sur mobile) -->
        <div
            class="hidden lg:flex lg:col-span-5 relative bg-neutral-900 items-center justify-center p-12 overflow-hidden">
            <div
                class="absolute inset-0 opacity-40 bg-[radial-gradient(#333_1px,transparent_1px)] [background-size:16px_16px]">
            </div>
            <div class="relative z-10 max-w-md text-center">
                <h1 class="text-3xl font-extrabold text-white tracking-tight sm:text-4xl">E-Commerce Platform</h1>
                <p class="mt-4 text-base text-neutral-400">Gérez vos commandes, suivez vos performances et développez
                    votre activité en toute simplicité.</p>
            </div>
        </div>

        <!-- CÔTÉ GAUCHE : Le Formulaire -->
        <div
            class="col-span-1 lg:col-span-7 flex flex-col justify-center px-4 py-12 sm:px-6 lg:px-20 xl:px-24 bg-white">
            <div class="mx-auto w-full max-w-sm">

                <!-- Logo / Identité abrégée -->
                <div class="mb-8">
                    <div
                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-neutral-900 text-white font-bold text-lg shadow-sm">
                        E</div>
                </div>

                <!-- Contenu dynamique (Login ou Register) -->
                {{ $slot }}

            </div>
        </div>

    </div>
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Change l'icône de l'œil ouvert vers l'œil barré
                eyeIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.024 10.024 0 014.122-5.512m3.013-1.833A10.019 10.019 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M12 15a3 3 0 110-6c.334 0 .656.054.957.155m-1.914 3.69A3 3 0 0012 15M3 3l18 18" />';
            } else {
                passwordInput.type = 'password';
                // Remet l'icône de l'œil ouvert standard
                eyeIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>

</body>

</html>
