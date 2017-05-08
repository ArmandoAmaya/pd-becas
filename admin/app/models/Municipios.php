<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Municipios extends Models{
	private $m;
	public function __construct(){
		parent::__construct();
		$this->table = 'municipio';
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

			if (Val::oneEmpty($request['c'], $request['id_estado'])) {
				throw new Exception('No pueden haber campos vacíos.');
				
			}

			$this->m = Str::firstM($request['c']);
			if (false != $this->db->pSelect('id', $this->table, "municipio='$this->m' $where", 'LIMIT 1')) {
				throw new Exception('Este Municipio ya está registrado.');
				
			}
			
			if (!Val::Letters($this->m)) {
				throw new Exception('El nombre del Municipio solo debe contener letras.');
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
	
		

		$this->db->pInsert([
			'municipio' => $this->m,
			'id_estado' => $request['id_estado']
		], $this->table);

		return array('success' => true, 'msg' => 'Registrado con éxito.');
	}

	# Edita un registro
	final public function Edit(array $request) {
		$error = $this->Errors($request,true);
		if (!is_bool($error)) {
			return $error;
		}
		$d = array(
			'municipio' => $this->m,
			'id_estado' => $request['id_estado']

		);
		$this->db->pUpdate($d, $this->table, "id='$this->id'");
		
		return array('success' => true, 'msg' => 'Editado con éxito.');
	}

	

	# Obtiene un registro
	final public function read(bool $edit = false){
		if (!$edit) {
			$municipio = $this->db->pSelect('*', $this->table);
			if (false == $municipio) {
				return false;
			}

			$estado = $this->db->prepare("SELECT estado FROM estado WHERE id = ?;");
			foreach ($municipio as $m) {
				$estado->execute(array($m['id_estado']));
				$est = $estado->fetch();

				$real_muni[] = array(
					'id' => $m['id'],
					'municipio' => $m['municipio'],
					'estado' => $est['estado']
				);
			}

			return $real_muni;
		}
		return $this->db->pSelect('*', $this->table, "id='$this->id'", 'LIMIT 1');
	}

	# Borra un registro 
	public function Delete(int $id){
		$this->db->pDelete($this->table, "id='$id'");
		return array('success' => true);
	}

	# Obtiene municipios
	final public function get_es(){
		return $this->select_array($this->db->pQuery('SELECT * FROM estado', true), 'estado');
	}

	public function __destruct() {
		parent::__destruct();
	}



}

?>
