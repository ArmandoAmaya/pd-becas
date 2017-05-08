<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Solicitudes extends Models{

	public function __construct(){
		parent::__construct();
		$this->table = 'grupo_solicitante';
	}

	

	# Obtiene un registro
	final public function read(){
		$gs = $this->db->pSelect('id_solicitante,id_grupo', $this->table);
		if (false == $gs) {
			return false;
		}
		
		$prepare = $this->db->prepare("SELECT 
			s.redes_sociales,
			s.tiempo_solicitud,
			s.condicion,
			s.nacionalidad, 
			s.curriculo, 
			p.nombre, 
			p.apellido, 
			p.cedula, 
			p.correo, 
			p.genero, 
			p.direccion, 
			p.telefono1, 
			p.telefono2, 
			p.fecha_nacimiento, 
			p.perfil,
			e.estado,
			m.municipio,
			pa.parroquia FROM 
			solicitante s 
			INNER JOIN personal p ON s.id_personal = p.id 
			INNER JOIN estado e ON  s.id_estado = e.id 
			INNER JOIN municipio m ON  s.id_municipio = m.id
			INNER JOIN parroquia pa ON  s.id_parroquia = pa.id WHERE s.id = ? AND (s.condicion = '1' or s.condicion = '2')");

		foreach ($gs as $sg) {
			$prepare->execute(array($sg['id_solicitante']));
			$solicitante = $prepare->fetch();
			if (false != $solicitante) {
				$real_reg[] = array(
					'id' => $sg['id_solicitante'],
					'id_grupo' => $sg['id_grupo'],
					'redes_sociales' => $solicitante['redes_sociales'],
					'tiempo_solicitud' => $solicitante['tiempo_solicitud'],
					'condicion' => $solicitante['condicion'],
					'direccion' => $solicitante['direccion'],
					'nacionalidad' => $solicitante['nacionalidad'],
					'curriculo' => $solicitante['curriculo'],
					'nombre' => $solicitante['nombre'],
					'apellido' => $solicitante['apellido'],
					'cedula' => $solicitante['cedula'],
					'correo' => $solicitante['correo'],
					'genero' => $solicitante['genero'],
					'telefono1' => $solicitante['telefono1'],
					'telefono2' => $solicitante['telefono2'],
					'fecha_nacimiento' => $solicitante['fecha_nacimiento'],
					'perfil' => $solicitante['perfil'],
					'estado' => $solicitante['estado'],
					'fecha_nacimiento' => $solicitante['fecha_nacimiento'],
					'municipio' => $solicitante['municipio'],
					'parroquia' => $solicitante['parroquia']
				);
			}
		}

		return $real_reg;
	}

	# Obtiene los registros de los aprobados,en espera y rechazados
	final public function read_list(int $condicion) {
		$sol = $this->db->pSelect('id,id_personal,redes_sociales,tiempo_solicitud', 'solicitante', "condicion = '$condicion'");
		if (false == $sol) {
			return false;
		}

		$p = $this->db->prepare("SELECT nombre,apellido,direccion,perfil FROM personal WHERE id = ?");
		foreach ($sol as $s) {
			$p->execute(array($s['id_personal']));
			$personal = $p->fetch();

			$real_solicitante[] = array(
				'id' => $s['id'],
				'redes_sociales' => $s['redes_sociales'],
				'tiempo_solicitud' => $s['tiempo_solicitud'],
				'nombre' => $personal['nombre'],
				'apellido' => $personal['apellido'],
				'direccion' => $personal['direccion'],
				'perfil' => $personal['perfil']
			);
		}
		return $real_solicitante;
	}

	# Entrevistas 
	final public function get_entrevistas() {
		return $this->select_array($this->db->pQuery("SELECT id,titulo FROM entrevista",true), 'titulo');
	}
	# Errores entrevista
	final private function errors_entrevista(array $request){
		try {
			$this->id = (int) $request['id'];
			
			if (false != $this->db->pSelect('id', 'solicitante', "id='$this->id' AND condicion = '2'", 'LIMIT 1')) {
				throw new Exception('Este solicitante ya está en entrevista.');
			}

			if (Val::Empty($request['entrevista'])) {
				throw new Exception('Debe escoger una entrevista.');
			}

			return false;
		} catch (Exception $e) {
			return array('success' => false, 'msg' => $e->getMessage());
		}
	}
	# Envia una entrevista
	final public function Entrevista(array $request){
		$error = $this->errors_entrevista($request);
		if (!is_bool($error)) {
			return $error;
		}
		$this->db->pInsert([
			'id_solicitante' => $this->id,
			'id_entrevista' => $request['entrevista']
		],'solicitante_entrevista');
		$this->db->pUpdate([
			'condicion' => 2
		],'solicitante', "id='$this->id'");
		return array('success' => true, 'msg' => 'Entrevista enviada.');
	}

	# Errores de la evaluación
	final public function evaluar_errors($request) {
		try {

			$id = (int) $request['id'];
			$cond = (int) $request['cond'];
		
			if (false != $this->db->pSelect('condicion', 'solicitante', "id='$id' AND condicion='$cond'", 'LIMIT 1')) {
				throw new Exception('Este solicitante ya fue evaluado.');
			}

			if (!in_array($cond, [3,4,5])) {
				throw new Exception('Condición Inválida.');
			}

			return false;
		} catch (Exception $e) {
			return array('success' => false, 'msg' => $e->getMessage());
		}
	}

	# Evalua un solicitante
	final public function Evaluar(array $request) {
		$error = $this->evaluar_errors($request);
		if (!is_bool($error)) {
			return $error;
		}
		$id = (int) $request['id'];
 		$this->db->pUpdate([
			'condicion' => $request['cond']
		],'solicitante', "id='$id'");

		if (4 == $request['cond']) {
			$id_grupo = (int) $request['id_grupo'];
			$this->db->pQuery("UPDATE grupo SET cupos = cupos + '1' WHERE id='$id_grupo' LIMIT 1",true);
		}


		return array('success' => true, 'msg' => 'Solicitante evaluado de forma exitosa.');
	}
	
	# Borra un registro 
	public function Delete(int $id){
		$this->db->pDelete($this->table, "id_solicitante='$id'");
		return array('success' => true);
	}

	public function __destruct() {
		parent::__destruct();
	}



}

?>
