function _grupos(){

	var l = Ladda.create( document.querySelector( '#grupos_submit' ) );

  	l.start();
  	toastr.clear();

	$.ajax({
		type: 'POST',
		url: 'app/ajax/grupos/edit',
		data: $('#grupos_form').serialize(),
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


if (document.getElementById('grupos_submit')) {
	document.getElementById('grupos_submit').addEventListener('click', function(e){
		e.preventDefault();
		_grupos();
	});
}


if (document.getElementById('grupos_form')) {
	document.getElementById('grupos_form').addEventListener('keypress', function(e){
		if (!e) e = window.event;
		var k = e.keyCode || e.which;
		if (k == 13) {
			_grupos();
		}

	});
}
