<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Classements') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <h3 class="text-xl text-gray-800 leading-tight">Phase de groupes</h3>
    </div>

    @foreach($groups as $group => $teams)
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-1/2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="staging-head">{{ "Groupe $group" }}</p>
                    <table class="staging-table mt-5">
                        <thead class="bg-gray-300">
                            <th class="my-2 py-2 staging-table-pays">Pays</th>
                            <th class="my-2 py-2 staging-table-pts">Pts</th>
                            <th class="my-2 py-2 staging-table-th">J</th>
                            <th class="my-2 py-2 staging-table-th">V</th>
                            <th class="my-2 py-2 staging-table-th">N</th>
                            <th class="my-2 py-2 staging-table-th">D</th>
                            <th class="my-2 py-2 staging-table-th">BP</th>
                            <th class="my-2 py-2 staging-table-th">BC</th>
                            <th class="my-2 py-2 staging-table-th">Diff</th>
                        </thead>
                        <tbody>
                        @foreach($teams as $team)
                            <tr class="my-2 py-5">
                                <td class="my-2 py-2 inline-flex items-center">
                                    <img class="staging-flag" src="{{$team['flag']}}" width="40px">
                                    <span>{{$team['name']}}</span>
                                </td>
                                <td class="my-2 py-2">{{$team['points']}}</td>
                                <td class="my-2 py-2">{{$team['played']}}</td>
                                <td class="my-2 py-2">{{$team['won']}}</td>
                                <td class="my-2 py-2">{{$team['draw']}}</td>
                                <td class="my-2 py-2">{{$team['lost']}}</td>
                                <td class="my-2 py-2">{{$team['goals_for']}}</td>
                                <td class="my-2 py-2">{{$team['goals_against']}}</td>
                                <td class="my-2 py-2">{{$team['goal_diff']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach

{{--     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <h3 class="text-xl text-gray-800 leading-tight">Phase finale</h3>
    </div>
    <div class="py-6">
        <div class=" mx-auto sm:px-6 lg:px-8 my-1/2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="tournament-container">
                        <div class="tournament-headers">
                            <h3 class="text-lg text-gray-800 font-semibold">8<sup>èmes</sup></h3>
                            <h3 class="text-lg text-gray-800 font-semibold">Quarts</h3>
                            <h3 class="text-lg text-gray-800 font-semibold">Demies</h3>
                            <h3 class="text-lg text-gray-800 font-semibold">Finale</h3>
                        </div>
                        <div class="tournament-brackets">
                            <ul class="bracket bracket-1">
                                @foreach($bracket as $b)
                                <li class="team-item flex shadow-sm sm:rounded-lg">
                                    <div class="inline-flex items-center flex-1">
                                        <img class="mx-2" width="20px" src="{{ $b[0]['flag'] }}">
                                        {{ $b[0]['name'] }}
                                    </div>
                                    <span class="flex-1"> <time>0</time><time>0</time> </span>
                                    <div class="inline-flex items-center flex-1">
                                        <img class="mx-2" width="20px" src="{{ $b[1]['flag'] ?? '' }}">
                                        {{ $b[1]['name'] }}
                                    </div>
                                </li>
                                @endforeach
                            </ul>  
                            <ul class="bracket bracket-2">
                                <li class="team-item flex shadow-sm sm:rounded-lg">
                                    <span class="flex-1">TBD</span>
                                    <span class="flex-1"> <time>0</time><time>0</time> </span>
                                    <span class="flex-1">TBD</span>
                                </li>
                                <li class="team-item flex shadow-sm sm:rounded-lg">
                                    <span class="flex-1">TBD</span>
                                    <span class="flex-1"> <time>0</time><time>0</time> </span>
                                    <span class="flex-1">TBD</span>
                                </li>
                                <li class="team-item flex shadow-sm sm:rounded-lg">
                                    <span class="flex-1">TBD</span>
                                    <span class="flex-1"> <time>0</time><time>0</time> </span>
                                    <span class="flex-1">TBD</span>
                                </li>
                                <li class="team-item flex shadow-sm sm:rounded-lg">
                                    <span class="flex-1">TBD</span>
                                    <span class="flex-1"> <time>0</time><time>0</time> </span>
                                    <span class="flex-1">TBD</span>
                                </li>
                            </ul>  
                            <ul class="bracket bracket-3">
                                <li class="team-item flex shadow-sm sm:rounded-lg">
                                    <span class="flex-1">TBD</span>
                                    <span class="flex-1"> <time>0</time><time>0</time> </span>
                                    <span class="flex-1">TBD</span>
                                </li>
                                <li class="team-item flex shadow-sm sm:rounded-lg">
                                    <span class="flex-1">TBD</span>
                                    <span class="flex-1"> <time>0</time><time>0</time> </span>
                                    <span class="flex-1">TBD</span>
                                </li>
                            </ul>  
                            <ul class="bracket bracket-4">
                                <li class="team-item flex shadow-sm sm:rounded-lg">
                                    <span class="flex-1">TBD</span>
                                    <span class="flex-1"> <time>0</time><time>0</time> </span>
                                    <span class="flex-1">TBD</span>
                                </li>
                            </ul>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>