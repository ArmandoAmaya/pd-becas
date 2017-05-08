function _admins(){

	var l = Ladda.create( document.querySelector( '#admins_submit' ) );

  	l.start();
  	toastr.clear();

  	var _data = new FormData(),
  		file = document.getElementById('input-file-now-custom-1'),
  		perfil = file.files[0];

  	_data.append('name', $('#name').val());
  	_data.append('ape', $('#ape').val());
  	_data.append('ced', $('#ced').val());
  	_data.append('email', $('#email').val());
  	_data.append('emaildos', $('#emaildos').val());
  	_data.append('pass', $('#pass').val());
  	_data.append('passdos', $('#passdos').val());
  	_data.append('perfil', perfil);
  	_data.append('gen',  $('input:radio[name=gen]:checked').val());

  	
	$.ajax({
		type: 'POST',
		url: 'app/ajax/admins/add',
		data: _data,
		contentType: false,
    	processData: false,
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

}


if (document.getElementById('admins_submit')) {
	document.getElementById('admins_submit').addEventListener('click', function(e){
		e.preventDefault();
		_admins();
	});
}


if (document.getElementById('admins_form')) {
	document.getElementById('admins_form').addEventListener('keypress', function(e){
		if (!e) e = window.event;
		var k = e.keyCode || e.which;
		if (k == 13) {
			_admins();
		}

	});
}
