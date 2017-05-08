<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Entrevistas extends Models{

	public function __construct(){
		parent::__construct();
		$this->table = 'entrevista';
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
			$t = $request['title'];
			if (false != $this->db->pSelect('id', $this->table, "titulo='$t' $where", 'LIMIT 1')) {
				throw new Exception('Esta entrevista ya está registrada.');
			}

			if (!Val::fullArray($request) or Val::Empty(strip_tags($request['desc']))) {
				throw new Exception('Los campos con <b>*</b> son necesarios.');
			}

			if (!preg_match("/[0-9]{2}-[0-9]{2}-[0-9]{4}/", $request['fecha'])) {
		        throw new Exception('El formato de la fecha debe ser DD-MM-YYYY.');
		    }
		    if (!preg_match("/[0-9]{2}:[0-9]{2}/", $request['hora'])) {
		    	throw new Exception('La hora debe estar en formato de 24H.');
		    }

		    if (strlen(strip_tags($request['desc'])) < 20) {
		    	throw new Exception('El mensaje es muy corto, debe contener como <b>mínimo 20 carácteres.</b>');
		    }

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
		
		$d = array(
			'titulo' => $request['title'],
			'mensaje' => $request['desc'],
			'fecha' => strtotime($request['fecha']),
			'hora' => strtotime($request['hora']),
			'lugar' => $request['lugar'],
			'formato' => $request['formato'] ?? 0

		);
		$this->db->pInsert($d, $this->table);

		return array('success' => true, 'msg' => 'Registrado con éxito.');
	}

	# Edita un registro
	final public function Edit(array $request) {
		$error = $this->Errors($request,true);
		if (!is_bool($error)) {
			return $error;
		}
		$d = array(
			'titulo' => $request['title'],
			'mensaje' => $request['desc'],
			'fecha' => strtotime($request['fecha']),
			'hora' => strtotime($request['hora']),
			'lugar' => $request['lugar'],
			'formato' => $request['formato'] ?? 0

		);
		$this->db->pUpdate($d, $this->table, "id='$this->id'");
		
		return array('success' => true, 'msg' => 'Editado con éxito.');
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
