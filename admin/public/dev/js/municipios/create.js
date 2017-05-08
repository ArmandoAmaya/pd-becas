function _municipios(){

	var l = Ladda.create( document.querySelector( '#municipios_submit' ) );

  	l.start();
  	toastr.clear();

	$.ajax({
		type: 'POST',
		url: 'app/ajax/municipios/add',
		data: $('#municipios_form').serialize(),
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


if (document.getElementById('municipios_submit')) {
	document.getElementById('municipios_submit').addEventListener('click', function(e){
		e.preventDefault();
		_municipios();
	});
}


if (document.getElementById('municipios_form')) {
	document.getElementById('municipios_form').addEventListener('submit', function(e){ e.preventDefault(); });
	document.getElementById('municipios_form').addEventListener('keypress', function(e){
		if (!e) e = window.event;
		var k = e.keyCode || e.which;
		if (k == 13) {
			_municipios();
		}

	});
}
