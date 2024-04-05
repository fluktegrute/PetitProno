<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Rejoins une ligue !') }}
        </h2>
    </header>

    <p class="mt-1 text-sm text-gray-600">
        Choisis une ligue à rejoindre pour te mesurer à ses membres
    </p>

    <form method="post" action="{{ route('league.join') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="league_id" :value="__('Ligue à rejoindre')" />
            <select id="league_id" name="league_id" class="mt-1 block w-full">
                @foreach($leagues as $league)
                    <option value="{{$league['id']}}">{{ $league['name'] }} par {{ $league['created_by'] }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Rejoindre cette ligue') }}</x-primary-button>

            @if (session('status') === 'league-joined')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Ligue rejointe !') }}</p>
            @endif
            @if (session('status') === 'already-joined')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Tu fais déjà partie de cette ligue') }}</p>
            @endif
        </div>
    </form>
</section>
