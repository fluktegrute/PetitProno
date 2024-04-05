<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ligue {{ $leagueName ?? ''}}
        </h2>
        @if($creator ?? false)
            <span class="league-creator text-gray-500 text-xs mx-5">by {{$creator}}</span>
        @endif
    </x-slot>

    @if($error)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-1/2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Tu ne fais pas partie de cette ligue :(
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-1/2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <table class="league-table mt-5">
                            <thead class="bg-gray-300">
                                @if($userIsCreator)
                                    <th class="my-2 py-2" style="width: 5%"></th>
                                    <th class="my-2 py-2" style="width: 30%">Nom</th>
                                    <th class="my-2 py-2" style="width: 15%">Score</th>
                                    <th class="my-2 py-2" style="width: 15%">Nombre de pronos</th>
                                    <th class="my-2 py-2" style="width: 15%">Scores exacts</th>
                                    <th class="my-2 py-2" style="width: 15%">Pronos gagnants</th>
                                    <th class="my-2 py-2" style="width: 5%">&nbsp;</th>
                                @else
                                    <th class="my-2 py-2" style="width: 5%"></th>
                                    <th class="my-2 py-2" style="width: 35%">Nom</th>
                                    <th class="my-2 py-2" style="width: 15%">Score</th>
                                    <th class="my-2 py-2" style="width: 15%">Nombre de pronos</th>
                                    <th class="my-2 py-2" style="width: 15%">Scores exacts</th>
                                    <th class="my-2 py-2" style="width: 15%">Pronos gagnants</th>
                                @endif
                            </thead>
                            <tbody>
                            @php $i = 1; @endphp
                            @foreach($league as $item)
                                <tr class="my-2 py-5">
                                    <td class="my-2 py-2">{!! 
                                        $i == 1 ? "$i &#127942;" : (
                                        $i == 2 ? "$i &#129352;" : (
                                        $i == 3 ? "$i &#129353;" : $i )) !!}</td>
                                    <td class="my-2 py-2">{{ $item['name'] }}</td>
                                    <td class="my-2 py-2">{{ $item['score'] }}</td>
                                    <td class="my-2 py-2">{{ $item['pronos_total'] }}</td>
                                    <td class="my-2 py-2">{{ $item['pronos_exact'] }}</td>
                                    <td class="my-2 py-2">{{ $item['pronos_won'] }}</td>
                                    @if($userIsCreator)
                                        @if(auth()->user()->id != $item['user_id'])
                                            <td class="my-2 py-2">
                                                <a href="{!! route('league.remove-user', ['league_id' => $leagueId, 'user_id' => $item['user_id']]) !!}" class="text-red-400 font-normal">
                                                    <span class="trashbin">{!! "&#128465;" !!}</span>
                                                </a>
                                            </td>
                                        @else
                                            <td class="my-2 py-2">&nbsp;</td>
                                        @endif
                                    @endif
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($userIsCreator)
            <div class="absolute bottom-0">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-1/2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            Supprimer la ligue ?
                            <a class="trashbin" href="{!! route('league.delete', ['id' => $leagueId]) !!}">{!! "&#128465;" !!}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</x-app-layout>