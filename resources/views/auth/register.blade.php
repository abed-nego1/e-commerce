<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Nom complet -->
        <div>
            <x-input-label for="name" :value="__('Nom complet')"
                class="text-xs font-semibold text-gray-700 uppercase tracking-wider" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Adresse Email -->
        <div>
            <x-input-label for="email" :value="__('Adresse Email')"
                class="text-xs font-semibold text-gray-700 uppercase tracking-wider" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" placeholder="exemple@domaine.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div>
            <x-input-label for="password" value="Mot de passe" />
            <div class="relative mt-1">
                <x-text-input id="password" class="block w-full pr-10" type="password" name="password" required
                    autocomplete="new-password" placeholder="••••••••" />
                <button type="button" onclick="togglePassword('password', 'eye-icon-reg')"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 mt-1.5 text-gray-400 hover:text-gray-600">
                    <svg id="eye-icon-reg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmer le mot de passe -->
        <div>
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
            <div class="relative mt-1">
                <x-text-input id="password_confirmation" class="block w-full pr-10" type="password"
                    name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-conf')"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 mt-1.5 text-gray-400 hover:text-gray-600">
                    <svg id="eye-icon-conf" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>


        <!-- Bouton d'inscription -->
        <div class="pt-2">
            <x-primary-button>
                S'inscrire
            </x-primary-button>
        </div>

        <!-- Lien vers la connexion -->
        <div class="text-center mt-4">
            <a class="text-sm text-gray-600 hover:text-gray-900 transition underline rounded-md"
                href="{{ route('login') }}">
                Déjà inscrit ? Connectez-vous
            </a>
        </div>

    </form>
</x-guest-layout>
