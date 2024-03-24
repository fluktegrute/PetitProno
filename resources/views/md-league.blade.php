<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ligue marque[DIGITALE]') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-1/2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="league-table mt-5">
                        <thead class="bg-gray-300">
                            <th class="my-2 py-2" style="width: 5%"></th>
                            <th class="my-2 py-2" style="width: 35%">Nom</th>
                            <th class="my-2 py-2" style="width: 15%">Score</th>
                            <th class="my-2 py-2" style="width: 15%">Nombre de pronos</th>
                            <th class="my-2 py-2" style="width: 15%">Scores exacts</th>
                            <th class="my-2 py-2" style="width: 15%">Pronos gagnants</th>
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
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>