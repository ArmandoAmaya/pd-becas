function _solicitantes(){

	var l = Ladda.create( document.querySelector( '#solicitantes_submit' ) );

  	l.start();
  	toastr.clear();

  	var _data = new FormData(),
      perfil = document.getElementById('perfil'),
      curriculo = document.getElementById('curriculo');

	_data.append('id', $('#id').val());
	_data.append('email', $('#email').val());
	_data.append('ced', $('#ced').val());
	_data.append('pass', $('#pass').val());
	_data.append('nombre', $('#nombre').val());
	_data.append('apellido', $('#apellido').val());
	_data.append('genero', $('input:radio[name=genero]:checked').val());
	_data.append('tel1', $('#tel1').val());
	_data.append('tel2', $('#tel2').val());
	_data.append('dir', $('#dir').val());
	_data.append('fecha', $('#fecha').val());
	_data.append('estado', $('#estado').val());
	_data.append('municipio', $('#municipio').val());
	_data.append('parroquia', $('#parroquia').val());
	_data.append('beca', $('#beca').val());
	_data.append('nacionalidad', $('input:radio[name=nacionalidad]:checked').val());
	_data.append('enviar_solicitud', $('#enviar_solicitud').is(':checked'));
	_data.append('perfil', perfil.files[0]);
	_data.append('c', curriculo.files[0]);

	var social_label = $('.social_label:checked'),
		social_array = new Array();
	if (social_label.length == 1) {
		social_array[0] = social_label.val();
		_data.append(social_label.val() + '_link',$('#'+social_label.val() + '_link').val());

	}else if (social_label.length > 1){
		social_label.each(function(i,e){
			social_array[i] = $(e).val();
			_data.append($(e).val()+'_link', $('#' + $(e).val() + '_link').val());
		});
	}
	_data.append('social_label', JSON.stringify(social_array));
	
	$.ajax({
		type: 'POST',
		url: 'app/ajax/solicitantes/edit',
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


$('#generate').on('click', function(e){
	e.preventDefault();
	let pass = (new Password).genera_contrasena();
	$('#pass').val(pass);
	$('#generada').html('<b>Contraseña Generada: </b> '+pass+'');
});

if ($('#estado').val() !=  '' && $('#estado').val() > 0) {
	ajax_locale(parseInt($('#estado').val()), 'municipio',parseInt($('#mun_selected').data('mun-selected')));
}

if ($('#mun_selected').data('mun-selected') !=  '' && $('#mun_selected').data('mun-selected') > 0) {
	ajax_locale(parseInt($('#mun_selected').data('mun-selected')), 'parroquia',parseInt($('#parr_selected').data('parr-selected')));
}


$('#estado').change(function(){
	var id = $(this).val();
	ajax_locale(id, 'municipio');
	
});

$('#municipio').change(function(){
	var id = $(this).val();
	ajax_locale(id, 'parroquia');
});
if (document.getElementById('solicitantes_submit')) {
	document.getElementById('solicitantes_submit').addEventListener('click', function(e){
		e.preventDefault();
		_solicitantes();
	});
}


if (document.getElementById('solicitantes_form')) {
	document.getElementById('solicitantes_form').addEventListener('keypress', function(e){
		if (!e) e = window.event;
		var k = e.keyCode || e.which;
		if (k == 13) {
			_solicitantes();
		}

	});
}


function ajax_locale(id, url, selected = null) {
	var select = null != selected && selected > 0 ? '&selected='+selected : '';
	$.ajax({
		type: 'GET',
		url: 'app/ajax/'+url,
		data: 'id='+id + select,
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