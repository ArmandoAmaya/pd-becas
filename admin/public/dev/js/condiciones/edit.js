function _condiciones(){

	var l = Ladda.create( document.querySelector( '#condiciones_submit' ) );

  	l.start();
  	toastr.clear();

	$.ajax({
		type: 'POST',
		url: 'app/ajax/condiciones/edit',
		data: $('#condiciones_form').serialize(),
		success: function(obj) {
			if (obj.success == true) {
				toastr.success(obj.msg, '<b>¡Realizado!</b>');
				setTimeout(function(){
					location.reload();
				}, 100);
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


if (document.getElementById('condiciones_submit')) {
	document.getElementById('condiciones_submit').addEventListener('click', function(e){
		e.preventDefault();
		_condiciones();
	});
}


if (document.getElementById('condiciones_form')) {
	document.getElementById('condiciones_form').addEventListener('submit', function(e){ e.preventDefault(); });
	document.getElementById('condiciones_form').addEventListener('keypress', function(e){
		if (!e) e = window.event;
		var k = e.keyCode || e.which;
		if (k == 13) {
			_condiciones();
		}

	});
}
