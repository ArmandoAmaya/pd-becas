<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Grupos extends Models{

	public function __construct(){
		parent::__construct();
		$this->table = 'grupo';
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



			if (Val::oneEmpty($request['name'], $request['cupos'], $request['hora_inicio'], $request['hora_salida'])) {
				throw new Exception('Los campos con * son necesarios.');
			}
			$n = $request['name'];
			if (false != $this->db->pSelect('id', $this->table, "grupo = '$n' $where", 'LIMIT 1')) {
				throw new Exception('Este grupo ya esta registrado.');
			}
			
			if (!Val::Hour($request['hora_inicio']) || !Val::Hour($request['hora_salida'])) {
				throw new Exception('Los campos de horas deben tener un formato de hora:minuto.');
				
			}
			if (!is_numeric($request['cupos'])) {
				throw new Exception('Los cupos deben ser numéricos.');
			}
			$hi = explode(':', $request['hora_inicio']);
			$hs = explode(':', $request['hora_salida']);
			
			if (($hi[0] > 24 or $hs[0] > 24) or ($hi[0] < 0 or $hs[0] < 0)) {
				throw new Exception('La hora debe tener un rango entre 0 y 24 horas.');
				
			}

			if (($hi[1] > 59 or $hs[1] > 59) or ($hi[1] < 0 or $hs[1] < 0)) {
				throw new Exception('Los minutos deben tener un rango entre 0 y 59 minutos.');
			}
			
			if (!isset($request['dias'])) {
				throw new Exception('Debes seleccionar al menos 1 dia.');
			}

			if (1 == sizeof($request['dias']) && !in_array($request['dias'][0],Gen::dias()) ) {
				throw new Exception('El dia seleccionado es inválido.');
			}else if ( sizeof($request['dias']) > 1) {
				foreach ($request['dias'] as $dia) {
					if (!in_array($dia, Gen::dias())) {
						throw new Exception('El dia "'.$dia.'" es inválido.');
					}
				}
			}

			if (isset($request['formato']) and !is_numeric($request['formato']) and ($request['formato'] > 1 or $request['formato'] < 0)) {
				throw new Exception('Formato inválido.');
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
		
		$hora_entrada = strtotime($request['hora_inicio']);
		$hora_salida = strtotime($request['hora_salida']);
		$d = array(
			$this->table => $request['name'],
			'dias' => json_encode($request['dias']),
			'hora_entrada' => $hora_entrada,
			'hora_salida' => $hora_salida,
			'cupos' => $request['cupos'],
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
		$hora_entrada = strtotime($request['hora_inicio']);
		$hora_salida = strtotime($request['hora_salida']);
		$d = array(
			$this->table => $request['name'],
			'dias' => json_encode($request['dias']),
			'hora_entrada' => $hora_entrada,
			'hora_salida' => $hora_salida,
			'cupos' => $request['cupos'],
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
