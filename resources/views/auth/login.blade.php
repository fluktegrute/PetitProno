<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 hidden" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
            </label>
        </div>

        @if (config('app.hcaptcha_sitekey'))
            <div class="h-captcha mt-4" data-sitekey="{{ config('app.hcaptcha_sitekey') }}"></div>
        @endif

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié ?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Connexion') }}
            </x-primary-button>
            @if (session('status') === 'invalid-captcha')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 5000)"
                    class="text-sm text-gray-600 ml-4"
                >{{ __('Captcha invalide.') }}</p>
            @endif
        </div>
        <div class="flex items-center space-between mt-4">
            @if (Route::has('register'))
                <span class="text-sm mr-2">Pas encore de compte ?</span>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                    Inscris-toi !
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
@if (config('app.hcaptcha_sitekey'))
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
@endif