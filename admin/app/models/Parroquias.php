<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Parroquias extends Models{

	private $p;

	public function __construct(){
		parent::__construct();
		$this->table = 'parroquia';
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

			if (Val::oneEmpty($request['c'], $request['id_municipio'])) {
				throw new Exception('No pueden haber campos vacíos.');
				
			}

			$this->p = Str::firstM($request['c']);
			if (false != $this->db->pSelect('id', $this->table, "parroquia='$this->p' $where", 'LIMIT 1')) {
				throw new Exception('Esta Parroquia ya está registrada.');
				
			}
			
			if (!Val::Letters($this->p)) {
				throw new Exception('El nombre de la Parroquia solo debe contener letras.');
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
			'parroquia' => $this->p,
			'id_municipio' => $request['id_municipio']
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
			'parroquia' => $this->p,
			'id_municipio' => $request['id_municipio']
		);
		$this->db->pUpdate($d, $this->table, "id='$this->id'");
		
		return array('success' => true, 'msg' => 'Editado con éxito.');
	}

	

	# Obtiene un registro
	final public function read(bool $edit = false){
		if (!$edit) {
			$parroquias = $this->db->pSelect('*', $this->table);
			if (false == $parroquias) {
				return false;
			}

			$prepare = $this->db->prepare("SELECT municipio FROM municipio WHERE id = ?; ");
			foreach ($parroquias as $p) {
				$prepare->execute(array($p['id_municipio']));
				$municipios = $prepare->fetch();

				$real_parroquias[] = array(
					'id' => $p['id'],
					'parroquia' => $p['parroquia'],
					'municipio' => $municipios['municipio']
				);
			}

			return $real_parroquias;
		}
		return $this->db->pSelect('*', $this->table, "id='$this->id'", 'LIMIT 1');
	}

	# Borra un registro 
	public function Delete(int $id){
		$this->db->pDelete($this->table, "id='$id'");
		return array('success' => true);
	}

	# Obtiene una parroquia
	final public function get_mu() {
		return $this->select_array($this->db->pQuery('SELECT * FROM municipio', true), 'municipio');
	}

	public function __destruct() {
		parent::__destruct();
	}



}

?>
