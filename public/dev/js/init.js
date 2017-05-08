if (document.getElementById('summernote')) {
	$('#summernote').summernote({
		height: 150,
	  	callbacks: {
	  	  	onChange: function(contents, $editable) {
	  	    	$('#desc').val(contents);
	  	  	}
	  	}
	});
}

function mostrarDetalles(id, title_group) {
	var defaults = Plugin.getDefaults("webuiPopover");

	(function() {
	  var tableContent = $('#group_info_'+id).html(),
	    tableSettings = {
	      title: title_group,
	      content: tableContent,
	      width: 500,
	      trigger: 'hover'

	    };
	  $('#item_'+id).webuiPopover($.extend({}, defaults, tableSettings));
	})();
}
function open_entrevista(id){

	$('#open_entrevista_'+id).fadeToggle();
}
function entrevista(id){
	var en = $('#entrevista_choose_'+id).val();

  	toastr.clear();

	$.ajax({
		type: 'POST',
		url: 'app/ajax/entrevista/enviar',
		data: 'id='+id + '&entrevista='+en,
		success: function(obj) {
			if (obj.success == true) {
				toastr.success(obj.msg, '<b>¡Realizado!</b>');
				setTimeout(function(){
					location.reload();
				}, 1000);
			}else{
				toastr.error(obj.msg, '<b>¡Error!</b>');
			}
		},
		error: function() {
			alert('##ERROR##');
		}
		
	});
}

function evaluar(id, cond){
	toastr.clear();

	$.ajax({
		type: 'POST',
		url: 'app/ajax/evaluar',
		data: 'id='+id + '&cond='+cond,
		success: function(obj) {
			if (obj.success == true) {
				toastr.success(obj.msg, '<b>¡Realizado!</b>');
				setTimeout(function(){
					location.reload();
				}, 1000);
			}else{
				toastr.error(obj.msg, '<b>¡Error!</b>');
			}
		},
		error: function() {
			alert('##ERROR##');
		}
		
	});
}
