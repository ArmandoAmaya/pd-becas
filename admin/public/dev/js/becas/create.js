function _becas(){

	var l = Ladda.create( document.querySelector( '#becas_submit' ) );

  	l.start();
  	toastr.clear();

  	var _data = new FormData(),
  		file = document.getElementById('input-file-now-custom-1'),
  		perfil = file.files[0];

  	_data.append('name', $('#name').val());
  	_data.append('tipo', $('#tipo').val());
  	_data.append('sede', $('#sede').val());
  	_data.append('desc', $('#desc').val());
  	_data.append('perfil', perfil);


	$.ajax({
		type: 'POST',
		url: 'app/ajax/becas/add',
		data: _data,
		contentType: false,
    	processData: false,
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


if (document.getElementById('becas_submit')) {
	document.getElementById('becas_submit').addEventListener('click', function(e){
		e.preventDefault();
		_becas();
	});
}


if (document.getElementById('becas_form')) {
	document.getElementById('becas_form').addEventListener('keypress', function(e){
		if (!e) e = window.event;
		var k = e.keyCode || e.which;
		if (k == 13) {
			_becas();
		}

	});
}
