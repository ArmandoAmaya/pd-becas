<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Becas extends Models{
	private $b;
	private $dir = './public/dev/images/becas/';
	public function __construct(){
		parent::__construct();
		$this->table = 'beca';
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
			$this->b = strip_tags($request['name']);
			if (false != $this->db->pSelect('id', $this->table, "beca='$this->b' $where", 'LIMIT 1')) {
				throw new Exception('Esta beca ya está registrada.');
			}

			if (!Val::fullArray($request) or Val::Empty(strip_tags($request['desc']))) {
				throw new Exception('Los campos con * son obligatorios.');
			}

			$this->uploader = new Uploader;

			if ($_FILES) {
				if ($_FILES['perfil']['size'] > (1024*1024)) {
					throw new Exception('La imagen no puede pesara mas de 1Mb.');
				}
				if (!Val::isImage( $_FILES['perfil']['name'] ) ) {
					throw new Exception('Solo se permiten archivos en formato: jpg,png,git,jpeg.');
				}
			}else if (!$_FILES and !$edit){
				throw new Exception('Debe existir una imagen para esta beca.');
				
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
			$this->table =>  $this->b,
			'tipo' => strip_tags($request['tipo']),
			'sede' => strip_tags($request['sede']),
			'descripcion' => $request['desc']
		);
		$this->db->pInsert($d, $this->table);
		$this->id = $this->db->lastInsertId();
		$this->upload_img($this->dir, $this->id);

		return array('success' => true, 'msg' => 'Registrado con éxito.');
	}

	# Edita un registro
	final public function Edit(array $request) {
		$error = $this->Errors($request,true);
		if (!is_bool($error)) {
			return $error;
		}
		$d = array(
			$this->table =>  $this->b,
			'tipo' => strip_tags($request['tipo']),
			'sede' => strip_tags($request['sede']),
			'descripcion' => $request['desc']
		);
		$this->db->pUpdate($d, $this->table, "id='$this->id'");
		$this->upload_img($this->dir, $this->id);

		
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

		if (is_dir('../../../'.$this->dir .$id .'/')) {
			Fl::rDir('../../../'.$this->dir .$id .'/');
		}
		return array('success' => true);
	}

	public function __destruct() {
		parent::__destruct();
	}



}

?>
