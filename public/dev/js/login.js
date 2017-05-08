
$('#login_submit').click(function(e){
	e.preventDefault();
	
	var l = Ladda.create( document.querySelector( '#login_submit' ) );

  	l.start();
  	toastr.clear();

	$.ajax({
		type: 'POST',
		url: 'app/ajax/login',
		data: $('#login_form').serialize(),
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
});