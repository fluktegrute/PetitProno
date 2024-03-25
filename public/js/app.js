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
	            	var tmp = data.split('|');
	            	if(tmp[0] == 'triche')
	            		alert("C'est pas beau de tricher, tu perds "+tmp[1]+" points :p");
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

	$("#played").hide();

	$(".played").on('click', function(){
		$("#played").show();
		$(".played").addClass('active');
		$(".to-be-played").removeClass('active');
		$("#to-be-played").hide();
	});
	$(".to-be-played").on('click', function(){
		$("#played").hide();
		$("#to-be-played").show();
		$(".played").removeClass('active');
		$(".to-be-played").addClass('active');
	});
});