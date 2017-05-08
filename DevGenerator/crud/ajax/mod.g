<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class {{model}} extends Models{

	public function __construct(){
		parent::__construct();
		$this->table = '{{table}}';
	}


	# Control de errores
	final private function Errors(array $request, bool $edit = false) {
		try {
			if($edit) {
				$this->id = (int) $request['id'];
				$where = "AND id <> '$this->id'";
			}else{
				$where = '';
			}

			
			// Validación de errores

			return false;
		} catch (Exception $e) {
			return array('success' => false, 'msg' => $e->getMessage());
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
		$this->db->pInsert($d, $this->table);*/

		return array('success' => false, 'msg' => 'Registrado con éxito.');
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
		$this->db->pUpdate($d, $this->table, "id='$this->id'");*/	
		
		return array('success' => false, 'msg' => 'Editado con éxito.');
	}

	

	# Obtiene un registro
	final public function read(bool $edit = false){
		if (!$edit) {
			return $this->db->pSelect('*', $this->table);
		}
		return $this->db->pSelect('*', $this->table, "id='$this->id'", 'LIMIT 1');
	}

	# Borra un registro 
	public function Delete(int $id){
		$this->db->pDelete($this->table, "id='$id'");
		return array('success' => true);
	}

	public function __destruct() {
		parent::__destruct();
	}



}

?>
