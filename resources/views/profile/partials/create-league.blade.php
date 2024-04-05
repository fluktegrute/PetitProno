<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Crée ta ligue !') }}
        </h2>
    </header>

    <p class="mt-1 text-sm text-gray-600">
        Crée ta propre ligue et invite d'autres membres à la rejoindre pour te mesurer à ta famille, tes amis, tes collègues...
    </p>

    <form method="post" action="{{ route('league.create') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="league_name" :value="__('Nom de la ligue')" />
            <x-text-input id="league_name" name="league_name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('league_name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Créer la ligue') }}</x-primary-button>

            @if (session('status') === 'league-created')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Ligue créée !') }}</p>
            @endif
        </div>
    </form>
</section>
