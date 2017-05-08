function _solicitantes(){

  toastr.clear();

  var _data = new FormData(),
      perfil = document.getElementById('perfil'),
      curriculo = document.getElementById('curriculo');

  _data.append('email', $('#email').val());
  _data.append('emaildos', $('#emaildos').val());
  _data.append('ced', $('#ced').val());
  _data.append('pass', $('#pass').val());
  _data.append('passdos', $('#passdos').val());
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
  _data.append('perfil', perfil.files[0]);
  _data.append('c', curriculo.files[0]);

	$.ajax({
		type: 'POST',
		url: 'app/ajax/solicitantes/add',
		data: _data,
    contentType: false,
    processData: false,
		success: function(obj) {
      console.log(obj);
			if (obj.success == true) {
				toastr.success(obj.msg, '<b>¡Realizado!</b>');
				setTimeout(function(){
				  window.location.href = obj.url;
				}, 100);
			}else{
				toastr.error(obj.msg, '<b>¡Error!</b>');
			}
		},
		error: function() {
			alert('##ERROR##');
		}
		
	});

}


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

(function() {
    var defaults = Plugin.getDefaults("wizard");

    var options = $.extend(true, {}, defaults, {
      onInit: function() {
        $('.wizard-content').formValidation({
          framework: 'bootstrap',
          locale: 'es_ES',
          fields: {
            email: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                },
                emailAddress: {
	              message: 'El correo no tiene un formato válido'
	            }
              },
              
            },
            ced: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                }
              }
            },
            pass: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                },
                stringLength: {
	              min: 6,
	              max: 30
	            }
              }
            },
            passdos: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                },
                stringLength: {
	              min: 6,
	              max: 30
	            }
              }
            },
            nombre: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                }
              }
            },
            apellido: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                }
              }
            },
            genero: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                }
              }
            },
            tel1: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                },
                phone: {
	              message: 'El valor no es un número de teléfono'
	            },
	            stringLength: {
	            	max: 11
	            }
              }
            },
            tel2: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                },
                phone: {
	              message: 'El valor no es un número de teléfono'
	            },
	            stringLength: {
	            	max: 11
	            }
              }
            },
            dir: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                }
              }
            },
            fecha: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                },
                date: {
	              format: 'YYYY-MM-DD'
	            }
              }
            },
            estado: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                }
              }
            },
            municipio: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                }
              }
            },
            parroquia: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                }
              }
            },
            beca: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                }
              }
            },
            nacionalidad: {
              validators: {
                notEmpty: {
                  message: 'Este campo es requerido'
                }
              }
            }
            
          },
          err: {
            clazz: 'text-help'
          },
          row: {
            invalid: 'has-danger'
          }

        })
        .on('success.form.fv', function(e){
        	e.preventDefault();
        	_solicitantes();
        });
      },
      validator: function() {
        var fv = $('.wizard-content').data('formValidation');

        var $this = $(this);

        // Validate the container
        fv.validateContainer($this);

        var isValidStep = fv.isValidContainer($this);
        if (isValidStep === false || isValidStep === null) {
          return false;
        }

        return true;
      },
      onFinish: function() {
      	
        _solicitantes();


      },
      
	  buttonLabels: {
	    next: 'Siguiente <i class="icon wb-chevron-right" aria-hidden="true"></i>',
	    back: '<i class="icon wb-chevron-left" aria-hidden="true"></i> Volver',
	    finish: 'Realizado <i class="icon wb-check" aria-hidden="true"></i>'
	  },
      buttonsAppendTo: '.panel-body'
    });

    console.dir(options);
    $("#exampleWizardFormContainer").wizard(options);
})();


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

$('#generate').change(function(){
  if ($(this).is(':checked')) {
    $('#pass').attr('disabled', 'disabled');
    $('#passdos').attr('disabled', 'disabled');
    let pass = (new Password).genera_contrasena();
    $('#pass_generated').html('Contraseña Generada: <span class="bg-blue-grey-700 text-color-box">'+pass+'</span>');
    $('#pass').val(pass);
    $('#passdos').val(pass);
  }else{
    $('#pass').removeAttr('disabled', 'disabled');
    $('#passdos').removeAttr('disabled', 'disabled');
    $('#pass_generated').html('');
    $('#pass').val('');
    $('#passdos').val('');
  }
});