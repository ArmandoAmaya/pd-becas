function _{{view}}(){

	var l = Ladda.create( document.querySelector( '#{{view}}_submit' ) );

  	l.start();
  	toastr.clear();

	$.ajax({
		type: '{{method}}',
		url: 'app/ajax/{{url}}',
		data: $('#{{view}}_form').serialize(),
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


if (document.getElementById('{{view}}_submit')) {
	document.getElementById('{{view}}_submit').addEventListener('click', function(e){
		e.preventDefault();
		_{{view}}();
	});
}


if (document.getElementById('{{view}}_form')) {
	document.getElementById('{{view}}_form').addEventListener('keypress', function(e){
		if (!e) e = window.event;
		var k = e.keyCode || e.which;
		if (k == 13) {
			_{{view}}();
		}

	});
}
