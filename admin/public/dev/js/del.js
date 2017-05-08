
function delete_this(url, id){
	swal({
        title: "Eliminar registro",
        text: "¿Estás seguro que deseas eliminar este registro?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: 'Si, eliminalo',
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) {
        if (isConfirm) {
        	$.ajax({
        		url: 'app/ajax/'+url+'/delete',
        		type: 'POST',
        		data: 'id='+id,
        		success: function (obj) {
        			if (obj.success) {
        				swal("Eliminado", "Registro eliminado con exito.", "success");
        				toastr.success('Se ha eliminado el registro de foma exitosa.', 'Registro eliminado');
        			}
        			$('#tr_'+url+'_'+id).remove();
        			
        		}
        	});
          

        } else {
          	swal("Cancelado", "El registro no se ha eliminado.", "error");
        }
    });
}