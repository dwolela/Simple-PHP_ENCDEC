(function () {
	
	$('.radio').click(function(event) {
		/* Act on the event */
		
		var radName=$("input[name='enc_type']:checked").val();

		if(radName=='shift'){
			$('.shift').removeClass('hide');
			$('.affine').addClass('hide');
		}
		else if(radName=='affine'){
			$('.shift').addClass('hide');
			$('.affine').removeClass('hide')
		}
		else{
			$('.shift').addClass('hide');
			$('.affine').addClass('hide');
		}

	});

	$('.slideToggle').on('click',function(){

		$('.form').slideToggle("fast",function() {
			if($('.slideToggle p').text()=='Less-'){
				
				$('.slideToggle p').text('More+');	
			}else{

				$('.slideToggle p').text('Less-');

			}

			});	
	});

	$('#command').change(function(){


		if($('#command').val()=='encrypt'){
				$('#th').text('Serial No');
		}else{
			$('#th').text("Shift by");
		}
		
	});

	$('.message').click(function(event) {
		//console.log($(event.target).text());
		$('#message p').text($(event.target).text());
		$('#message').removeClass('hide');
	});

})();