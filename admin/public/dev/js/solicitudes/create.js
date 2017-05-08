function _solicitudes(){

	var l = Ladda.create( document.querySelector( '#solicitudes_submit' ) );

  	l.start();
  	toastr.clear();

	$.ajax({
		type: 'POST',
		url: 'app/ajax/solicitudes/add',
		data: $('#solicitudes_form').serialize(),
		success: function(obj) {
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

}


if (document.getElementById('solicitudes_submit')) {
	document.getElementById('solicitudes_submit').addEventListener('click', function(e){
		e.preventDefault();
		_solicitudes();
	});
}


if (document.getElementById('solicitudes_form')) {
	document.getElementById('solicitudes_form').addEventListener('keypress', function(e){
		if (!e) e = window.event;
		var k = e.keyCode || e.which;
		if (k == 13) {
			_solicitudes();
		}

	});
}
