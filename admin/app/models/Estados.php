<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Estados extends Models{
	private $e;
	public function __construct(){
		parent::__construct();
		$this->table = 'estado';
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

			$this->e = Str::firstM($request['c']);
			if (false != $this->db->pSelect('id', $this->table, "estado='$this->e' $where", 'LIMIT 1')) {
				throw new Exception('Este Estado ya está registrado.');
				
			}
			if (Val::Empty($this->e)) {
				throw new Exception('El campo no puede esta vacío.');
			}
			if (!Val::Letters($this->e)) {
				throw new Exception('El nombre del Estado solo debe contener letras.');
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
		
		
		$this->db->pInsert([$this->table => $this->e], $this->table);

		return array('success' => true, 'msg' => 'Registrado con éxito.');
	}

	# Edita un registro
	final public function Edit(array $request) {
		$error = $this->Errors($request,true);
		if (!is_bool($error)) {
			return $error;
		}
		
		$this->db->pUpdate([$this->table => $this->e], $this->table, "id='$this->id'");
		
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
