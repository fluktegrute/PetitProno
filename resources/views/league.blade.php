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
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-1/2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-semibold text-l pb-2">Classement de la ligue</h3>
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

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-1/2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-semibold text-l pb-10">Commentaires</h3>
                        <div class="comments">
                        @foreach($comments as $comment)
                            <table class="comment w-full">
                                <tr>
                                    <td class="comment_head py-10 px-2 md:px-5 w-1/4 md:w-1/3">
                                        <div class="comment_author font-bold">{{$comment->user->name}}</div>
                                        <div class="comment_date text-gray-500 text-xs ml-5">le {{date("d/m/Y à H:i", strtotime($comment->comment_date))}}</div>
                                    </td>
                                    <td class="comment_body p-2 md:p-10 w-3/4 md:w-2/3">
                                        {!! $comment->comment !!}
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                        </div>
                    </div>
                    <div class="p-6 text-gray-900">
                        <h3 class="font-semibold text-l">Ajouter un commentaire</h3>
                        <form method="post" action="{{ route("league.post-comment") }}">
                            @csrf
                            <x-trix-editor></x-trix-editor>
                            <input type="hidden" id="league_id" name="league_id" value="{{$leagueId}}">
                            <div class="py-2 text-right">
                                <x-primary-button>Envoyer</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if($userIsCreator)
            <div class="sticky bottom-0 left-0">
                <div class="w-1/6 sm:px-6 lg:px-8 my-1/2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="flex p-6 text-gray-900">
                            <div class="flex-1">Supprimer la ligue ?</div>
                            <div class="flex-none text-right">
                                <a class="trashbin" href="{!! route('league.delete', ['id' => $leagueId]) !!}">{!! "&#128465;" !!}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</x-app-layout>