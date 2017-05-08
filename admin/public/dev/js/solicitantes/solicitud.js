$('#solicitud_submit').click(function(){
	var l = Ladda.create( document.querySelector( '#solicitud_submit' ) ),
		grupo_id = $('.grupo_id:checked').val(),
		cpath = $('#path').val(),
		beca_id = $('#beca_id').val(),
		id = $('#id_solicitante').val();

  	l.start();
  	toastr.clear();



	$.ajax({
		type: 'POST',
		url: 'app/ajax/solicitantes/solicitud',
		data: 'grupo_id='+grupo_id+'&path='+cpath+'&beca_id='+beca_id +'&id='+id,
		success: function(obj) {
			console.log(obj);
			if (obj.success == true) {
				toastr.success(obj.msg, '<b>¡Realizado!</b>');
				setTimeout(function(){
					location.reload();
				}, 1000);
			}else{
				toastr.error(obj.msg, '<b>¡Error!</b>');
			}
			l.stop();
		},
		error: function() {
			alert('##ERROR##');
		}
		
	});

});

