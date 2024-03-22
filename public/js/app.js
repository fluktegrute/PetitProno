jQuery('document').ready(function($){
	$('.input-prono').each(function(){
		$(this).on('change', function(){
			$.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });

			var match_id = $(this).data('match');
			var equipe = $(this).data('equipe');
			var score = $(this).val();

	        $.ajax({
	            url: '/set-prono',
	            type: 'POST',
	            data: {
	                match_id: match_id,
	                equipe: equipe,
	                score: score,
	            },

	            success: function(data){
	            	console.log(data);
	            }
	        });
		});
	});

	$('.chbx-prono').each(function(){
		$(this).on('change', function(){
			$.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });

			var match_id = $(this).data('match');
			var equipe = $(this).data('equipe');
			var booster = $(this).prop('checked');

	        $.ajax({
	            url: '/set-booster',
	            type: 'POST',
	            data: {
	                match_id: match_id,
	                equipe: equipe,
	                booster: booster,
	            },

	            success: function(data){
	            	console.log(data);
	            	if(data == 'no_more_boosters'){
	            		alert('Tu es à court de boosters !');
	            	}
	            }
	        });
		});
	});


});