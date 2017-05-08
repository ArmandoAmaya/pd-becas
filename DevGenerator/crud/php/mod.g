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
			$ruta = $edit ? '{{view}}/edit/'.$this->id . '/?error=' : '{{view}}/add/?error=';
   			Str::redir($ruta.$e->getMessage());   			
   			exit(1);
		}
	}

	# Agrega un registro
	final public function Add(array $request) {
		$error = $this->Errors($request);
		if (!is_bool($error)) {
			return $error;
		}
		/*
		$d = array(
			'campo' => 'valor'
		);
		$this->db->pInsert($d, '{{table}}');*/

		Str::redir('{{view}}/add/?success=true');
    	exit(1);
	}

	# Edita un registro
	final public function Edit(array $request) {
		$error = $this->Errors($request,true);
		if (!is_bool($error)) {
			return $error;
		}
		/*$d = array(
			'campo' => 'valor'
		);
		$this->db->pUpdate($d, '{{table}}', "id='$this->id'");*/	
		
		Str::redir('{{view}}/edit/'.$this->id.'/?success=true'); 
    	exit(1);
	}

	

	# Obtiene un registro
	final public function read(bool $edit = false){
		if (!$edit) {
			return $this->db->pSelect('*', '{{table}}');
		}
		return $this->db->pSelect('*', '{{table}}', "id='$this->id'", 'LIMIT 1');
	}

	# Borra un registro 
	public function Delete(int $id){
		$this->db->pDelete('{{table}}', "id='$id'");
		Str::redir('{{view}}/');
	}

	public function __destruct() {
		parent::__destruct();
	}



}

?>
