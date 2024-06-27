<div class="flex justify-center py-2 w-full border-b-2 border-gray-400">
	<div class="flex-1 text-center p-2">
		{{ $pronos['home']['score'] }}
	</div>
	<div class="flex-1 text-center p-2">
		<div class="flex">
	        <div class="flex flex-nowrap items-center">
	            <img class="inline match-flag" src="{{$pronos['home']['flag']}}" width="32px"> 
	            <span class="font-semibold">{{ $pronos['home']['name'] }}</span> 
	        </div>
			<div class="flex items-center px-2"> - </div>
	        <div class="flex flex-nowrap items-center">
	            <span class="font-semibold">{{ $pronos['away']['name'] }}</span> 
	            <img class="inline match-flag" src="{{$pronos['away']['flag']}}" width="32px"> 
	        </div>
	    </div>
	</div>
	<div class="flex-1 text-center p-2">
		{{ $pronos['away']['score'] }}
	</div>
</div>

@foreach($pronos['pronos'] as $prono)
	@php 
		$border = $prono['booster_used'] ? "border rounded border-indigo-300" : "";
	@endphp
	@if($border)
		<span class="text-[8px] font-semibold text-indigo-400 relative top-5 left-2">Booster</span>
	@endif
	<div class="flex justify-center py-2 w-full {{ $border }}">
		<div class="flex-1 text-center p-2">
			{{ $prono['home_score'] }}
		</div>
		<div class="flex-1 text-center p-2">
			{{ $prono['user'] }}
		</div>
		<div class="flex-1 text-center p-2">
			{{ $prono['away_score'] }}
		</div>
	</div>
@endforeach