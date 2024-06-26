<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Matches') }}
        </h2>
    </x-slot>

    @if(!$hasWinner)
        <div class="py-1/2 text-center bg-orange-300">
            Tu n'as pas encore choisi ton poney, va le faire sur la page de <a href="/profile" class="profile-link">ton profil !</a>
        </div>
    @endif
    <div class="py-2 text-center mx-auto">
        <ul class="flex inline-flex text-lg font-medium text-center text-gray-500 border-b border-gray-200 mx-auto">
            <li class="me-2">
                <a href="#" class="to-be-played inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 active">À venir</a>
            </li>
            <li class="me-2">
                <a href="#" class="played inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50">Passés</a>
            </li>
        </ul>
    </div>

    <div class="py-12" id="to-be-played">
        @foreach($matches as $match)
            @php if(!$match['is_available']) continue; @endphp
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-10">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p class="bg-gray-200 text-gray-800 py-5 text-center rounded-xl mb-5">
                            <span class="match-date">{{ $match['date'] }}</span>
                            <br>
                            <span class="match-stage">{{ $match['stage'] }}{{ $match['group'] ? " - {$match['group']}" : "" }}</span>
                        </p>
                        <br>
                        <div class="grid grid-cols-5 gap-4">
                            <div class="col-span-2 mx-auto my-0">
                                <div class="flex flex-nowrap items-center">
                                    <img class="inline match-flag" src="{{$match['home_team']['flag']}}" width="64px"> 
                                    <span class="match-team">{{ $match['home_team']['name'] }}</span> 
                                </div>
                                <div class="my-2 text-center">
                                    <input type="number" class="input-prono bg-gray-50 border border-gray-300 text-gray-900 rounded-lg text-right w-1/3" data-match="{{$match['id']}}" data-equipe="home" value="{{ $match['home_team']['prono'] }}" {{ !$match['is_available'] ? 'disabled' : '' }}>
                                </div>
                            </div>
                            <div class="my-auto mx-auto"><p class="text-s"><strong>VS</strong></p></div>
                            <div class="col-span-2 mx-auto my-0">
                                <div class="flex flex-nowrap items-center">
                                    <span class="match-team">{{ $match['away_team']['name'] }}</span> 
                                    <img class="inline match-flag" src="{{$match['away_team']['flag']}}" width="64px"> 
                                </div>
                                <div class="my-2 text-center">
                                    <input type="number" class="input-prono bg-gray-50 border border-gray-300 text-gray-900 rounded-lg text-right w-1/3" data-match="{{$match['id']}}" data-equipe="away" value="{{ $match['away_team']['prono'] }}" {{ !$match['is_available'] ? 'disabled' : '' }}>
                                </div>
                            </div>
                            @if($match['is_available'])
                            <div class="col-span-5 mx-auto my-0">
                                <input type="checkbox" class="chbx-prono" data-match="{{$match['id']}}" id="booster-{{$match['id']}}" {{$match['prono_booster'] ? 'checked' : ''}}>
                                <label for="booster-{{$match['id']}}">Utiliser un booster sur ce match</label>
                            </div>
                            @endif
                        </div>
                        @if(!$match['is_available'])
                        <div class="flex flex-nowrap items-center py-2 my-2 {{ $match['prono_result'] == 2 ? 'prono-exact' : ($match['prono_result'] == 1 ? 'prono-won' : 'prono-lost') }}">
                            <div class="mx-auto my-0">
                                <div class="flex flex-nowrap items-center">
                                    {{ $match['home_team']['score'] }}
                                </div>
                            </div>
                            <div class="text-center mx-auto">{!! $match['prono_result'] == 2 ? "Perfect, bien ouèj !&nbsp;&#129395;" : ($match['prono_result'] == 1 ? "Gagné&nbsp;&#128526;" : "Dommage... &nbsp;&#128533;") !!}</div>
                            <div class="mx-auto my-0">
                                <div class="flex flex-nowrap items-center">
                                    {{ $match['away_team']['score'] }}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="py-12" id="played">
        @foreach($matches as $match)
            @php if($match['is_available']) continue; @endphp
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-10">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p class="bg-gray-200 text-gray-800 py-5 text-center rounded-xl mb-5 match hover:cursor-pointer" data-match_id="{{ $match['id'] }}">
                            <span class="match-date">{{ $match['date'] }}</span>
                            <br>
                            <span class="match-stage">{{ "{$match['stage']} - {$match['group']}" }}</span>
                        </p>
                        <br>
                        <div class="grid grid-cols-5 gap-4">
                            <div class="col-span-2 mx-auto my-0">
                                <div class="flex flex-nowrap items-center">
                                    <img class="inline match-flag" src="{{$match['home_team']['flag']}}" width="64px"> 
                                    <span class="match-team">{{ $match['home_team']['name'] }}</span> 
                                </div>
                                <div class="my-2 text-center">
                                    <input type="number" class="input-prono bg-gray-50 border border-gray-300 text-gray-900 rounded-lg text-right w-1/3" data-match="{{$match['id']}}" data-equipe="home" value="{{ $match['home_team']['prono'] }}" {{ !$match['is_available'] ? 'disabled' : '' }}>
                                </div>
                            </div>
                            <div class="my-auto mx-auto"><p class="text-s"><strong>VS</strong></p></div>
                            <div class="col-span-2 mx-auto my-0">
                                <div class="flex flex-nowrap items-center">
                                    <span class="match-team">{{ $match['away_team']['name'] }}</span> 
                                    <img class="inline match-flag" src="{{$match['away_team']['flag']}}" width="64px"> 
                                </div>
                                <div class="my-2 text-center">
                                    <input type="number" class="input-prono bg-gray-50 border border-gray-300 text-gray-900 rounded-lg text-right w-1/3" data-match="{{$match['id']}}" data-equipe="away" value="{{ $match['away_team']['prono'] }}" {{ !$match['is_available'] ? 'disabled' : '' }}>
                                </div>
                            </div>
                            @if($match['is_available'])
                            <div class="col-span-5 mx-auto my-0">
                                <input type="checkbox" class="chbx-prono" data-match="{{$match['id']}}" id="booster-{{$match['id']}}" {{$match['prono_booster'] ? 'checked' : ''}}>
                                <label for="booster-{{$match['id']}}">Utiliser un booster sur ce match</label>
                            </div>
                            @endif
                        </div>
                        @if(!$match['is_available'])
                        <div class="flex flex-nowrap items-center py-2 my-2 {{ $match['prono_result'] == 2 ? 'prono-exact' : ($match['prono_result'] == 1 ? 'prono-won' : 'prono-lost') }}">
                            <div class="mx-auto my-0">
                                <div class="flex flex-nowrap items-center">
                                    {{ $match['home_team']['score'] }}
                                </div>
                            </div>
                            <div class="text-center mx-auto">{!! $match['prono_result'] == 2 ? "Perfect, bien ouèj !&nbsp;&#129395;" : ($match['prono_result'] == 1 ? "Gagné&nbsp;&#128526;" : "Dommage... &nbsp;&#128533;") !!}</div>
                            <div class="mx-auto my-0">
                                <div class="flex flex-nowrap items-center">
                                    {{ $match['away_team']['score'] }}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>

<!-- Modal content -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2></h2>
            <div class="modal-title"></div>
        </div>
        <div class="modal-body"></div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>