function reg(){

	var l = Ladda.create( document.querySelector( '#reg_submit' ) );

  	l.start();
  	toastr.clear();

	$.ajax({
		type: 'POST',
		url: 'app/ajax/reg',
		data: $('#reg_form').serialize(),
		success: function(obj) {
			console.log(obj);
			if (obj.success == true) {
				toastr.success(obj.msg, '<b>¡Éxito!</b>');
				setTimeout(function(){
					alert('Debes Confirmar tu cuenta, para ello te hemos enviado un mensaje con todos los pasos necesarios a tu correo.');
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


if (document.getElementById('reg_submit')) {
	document.getElementById('reg_submit').addEventListener('click', function(e){
		e.preventDefault();
		reg();
	});
}

if (document.getElementById('reg_form')) {
	document.getElementById('reg_form').addEventListener('submit', function(){
		if (!e) e = window.event;
		var k = e.keyCode || e.which;
		if (k == 13) {
			reg();
		}
	});
}

$('#estado').change(function(){
	var id = $(this).val();
	ajax_locale(id, 'municipio');
	
});

$('#municipio').change(function(){
	var id = $(this).val();
	ajax_locale(id, 'parroquia');
});

function ajax_locale(id, url) {
	$.ajax({
		type: 'GET',
		url: 'app/ajax/'+url,
		data: 'id='+id,
		success: function(resp){
			if (resp == '') {
				$('#'+url).attr('disabled', 'disabled');
				$('#'+url).find('option').not('option:first-child').remove();
			}else{
				$('#'+url).find('option').not('option:first-child').remove();
				$('#'+url).append(resp);
				$('#'+url).removeAttr('disabled');
			}
						
		},
		error: function(){
			alert('Error al traer los municipios.');
		}
	});
}
