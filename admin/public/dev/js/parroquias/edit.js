function _parroquias(){

	var l = Ladda.create( document.querySelector( '#parroquias_submit' ) );

  	l.start();
  	toastr.clear();

	$.ajax({
		type: 'POST',
		url: 'app/ajax/parroquias/edit',
		data: $('#parroquias_form').serialize(),
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


if (document.getElementById('parroquias_submit')) {
	document.getElementById('parroquias_submit').addEventListener('click', function(e){
		e.preventDefault();
		_parroquias();
	});
}


if (document.getElementById('parroquias_form')) {
	document.getElementById('parroquias_form').addEventListener('submit', function(e){ e.preventDefault(); });
	document.getElementById('parroquias_form').addEventListener('keypress', function(e){
		if (!e) e = window.event;
		var k = e.keyCode || e.which;
		if (k == 13) {
			_parroquias();
		}

	});
}
