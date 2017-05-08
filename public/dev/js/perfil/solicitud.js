$('#solicitud_submit').click(function(e){
	e.preventDefault();
	var l = Ladda.create( document.querySelector( '#solicitud_submit' ) );

  	l.start();
  	toastr.clear();

	$.ajax({
		type: 'POST',
		url: 'app/ajax/perfil/solicitud',
		data: $('#form_solicitud').serialize(),
		success: function(obj) {
			console.log(obj);
			if (obj.success == true) {
				toastr.success(obj.msg, '<b>¡Éxito!</b>');
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