
	$('#searchname').autocomplete({

		
		source : '{!!URL::route('autocomplete')!!}',
		minlenght:1,
		autoFocus:true,
		select:function(e,ui){
			
		//$('#id').val(ui.item.id);
		//$('#name').val(ui.item.value);

		}

	});






