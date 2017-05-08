function _entrevistas(){

	var l = Ladda.create( document.querySelector( '#entrevistas_submit' ) );

  	l.start();
  	toastr.clear();

	$.ajax({
		type: 'POST',
		url: 'app/ajax/entrevistas/add',
		data: $('#entrevistas_form').serialize(),
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


if (document.getElementById('entrevistas_submit')) {
	document.getElementById('entrevistas_submit').addEventListener('click', function(e){
		e.preventDefault();
		_entrevistas();
	});
}


if (document.getElementById('entrevistas_form')) {
	document.getElementById('entrevistas_form').addEventListener('keypress', function(e){
		if (!e) e = window.event;
		var k = e.keyCode || e.which;
		if (k == 13) {
			_entrevistas();
		}

	});
}
