function _estados(){

	var l = Ladda.create( document.querySelector( '#estados_submit' ) );

  	l.start();
  	toastr.clear();

	$.ajax({
		type: 'POST',
		url: 'app/ajax/estados/add',
		data: $('#estados_form').serialize(),
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


if (document.getElementById('estados_submit')) {
	document.getElementById('estados_submit').addEventListener('click', function(e){
		e.preventDefault();
		_estados();
	});
}


if (document.getElementById('estados_form')) {
	document.getElementById('estados_form').addEventListener('submit', function(e){ e.preventDefault(); });
	document.getElementById('estados_form').addEventListener('keypress', function(e){
		if (!e) e = window.event;
		var k = e.keyCode || e.which;
		if (k == 13) {
			_estados();
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
