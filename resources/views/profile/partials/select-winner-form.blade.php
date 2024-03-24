<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Qui va gagner ?') }}
        </h2>
    </header>

    @if($teams)
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Tu peux choisir l'équipe qui, selon toi, va gagner l'Euro.<br>
            Si ton prono s'avère exact, ça te rapportera <b>50 points</b> en fin de compétition.<br>
            <span class="text-red-500 font-bold">Attention : une fois ton vainqueur sélectionné, tu ne pourras pas revenir en arrière !
        </p>

        <form method="post" action="{{ route('winner.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="set_winner" :value="__('Vainqueur')" />
                <select id="set_winner" name="set_winner" class="mt-1 block w-full">
                    @foreach($teams as $team)
                        <option value="{{$team->id}}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Valider') }}</x-primary-button>

                @if (session('status') === 'winner-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Enregistré.') }}</p>
                @endif
            </div>
        </form>
    @else
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Ton poney gagnant : <span class="text-cyan-500 font-bold">{{$has_winner}}</span><br>
            Si ton prono s'avère exact, ça te rapportera <b>50 points</b> en fin de compétition.
        </p>
    @endif
</section>
