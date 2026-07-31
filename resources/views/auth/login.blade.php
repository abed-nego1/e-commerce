<x-guest-layout>
    <!-- Statut de la session -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Adresse Email -->
        <div>
            <x-input-label for="email" value="Adresse Email"
                class="text-xs font-semibold text-gray-700 uppercase tracking-wider" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" placeholder="exemple@domaine.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div>
            <div class="flex justify-between items-center">
                <x-input-label for="password" value="Mot de passe" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-gray-600 hover:text-gray-900 transition underline rounded-md"
                        href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
            <div class="relative mt-1">
                <x-text-input id="password" class="block w-full pr-10" type="password" name="password" required
                    autocomplete="current-password" placeholder="••••••••" />
                <button type="button" onclick="togglePassword('password', 'eye-icon-login')"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 mt-1.5 text-gray-400 hover:text-gray-600">
                    <svg id="eye-icon-login" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <!-- Se souvenir de moi -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-gray-900 shadow-sm focus:ring-gray-900" name="remember">
                <span class="ms-2 text-sm text-gray-600">Se souvenir de moi</span>
            </label>
        </div>

        <!-- Bouton de connexion -->
        <div class="pt-2">
            <x-primary-button>
                Se connecter
            </x-primary-button>
        </div>

        <!-- Lien vers l'inscription -->
        <div class="text-center mt-4">
            <a class="text-sm text-gray-600 hover:text-gray-900 transition underline rounded-md"
                href="{{ route('register') }}">
                Pas encore de compte ? S'inscrire
            </a>
        </div>
    </form>
</x-guest-layout>
