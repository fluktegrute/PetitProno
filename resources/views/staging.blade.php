<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Classements') }}
        </h2>
    </x-slot>

    @foreach($groups as $group => $teams)
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-1/2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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
</x-app-layout>