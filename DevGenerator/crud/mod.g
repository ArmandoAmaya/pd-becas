<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class {{model}} extends Models{

	public function __construct(){
		parent::__construct();
	}


	# Control de errores
	final private function Errors(array $request, bool $edit = false) {
		try {
			if($edit) {
				$this->id = (int) $request['id'];
			}

			// Validación de errores

			return false;
		} catch (Exception $e) {
			// Capturar error
		}
	}

	# Agrega un registro
	final public function Add(array $request) {
		$error = $this->Errors($request);
		if (!is_bool($error)) {
			return $error;
		}
		
		// Código para insertar
	}

	# Edita un registro
	final public function Edit(array $request) {
		$error = $this->Errors($request,true);
		if (!is_bool($error)) {
			return $error;
		}
		
		// Codigo para editar
	}

	

	# Obtiene un registro
	final public function read(bool $edit = false){
		// Código para borrar
	}

	# Borra un registro 
	public function Delete(int $id){
		// Código para eliminar

	}

	public function __destruct() {
		parent::__destruct();
	}



}

?>
