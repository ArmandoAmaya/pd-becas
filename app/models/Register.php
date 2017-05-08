<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Register extends Models{
	private $e;
	private $c;
	public function __construct(){
		parent::__construct();
		$this->table = 'personal';
	}

	final private function errors(array $request){
		try {

			$this->e = strtolower($request['email']);
			$this->c = $request['ced'];

			if (false != $this->db->pSelect('id', 'personal', "(correo = '$this->e' OR cedula = '$this->c')", 'LIMIT 1')) {
				throw new Exception('Este usuario ya está registrado.');
			}

			if (!Val::fullArray($request)) {
				throw new Exception('Los campos con <b>*<b> son necesarios.');
			}
			if (!Val::Email($request['email']) or !Val::Email($request['emaildos'])) {
				throw new Exception('El correo eletrónico debe tener un formato válido.');
			}
			if (strtolower($request['email']) != strtolower($request['emaildos'])) {
				throw new Exception('Los correos no coinciden.');
			}
			if (!is_numeric($request['ced'])) {
				throw new Exception('Los campos de "Cédula de identidad" y "Número de teléfono" solo deben contener números.');
			}
			if (!isset($request['tyc'])) {
				throw new Exception('Debes aceptar los términos y condiciones.');
			}
			$f = new Front;
			$e = array_keys($f->get_location('estado'));
			$m = array_keys($f->get_location('municipio'));
			$p = array_keys($f->get_location('parroquia'));
			if (!in_array($request['estado'], $e)) {
				throw new Exception('Debes seleccionar un Estado.');
			}

			if (!in_array($request['municipio'], $m)) {
				throw new Exception('Debes seleccionar un Municipio.');
			}

			if (!in_array($request['parroquia'], $p)) {
				throw new Exception('Debes seleccionar una Parroquia.');
			}
			
			return false;
		} catch (Exception $e) {
			return array('success' => false, 'msg' => $e->getMessage());
		}
	}
	
	final public function Reg(array $request){
		$error = $this->errors($request);
		if (!is_bool($error)) {
			return $error;
		}
		$f = time();
		$this->db->pInsert([
			'nombre' => strtolower($request['name']),
			'apellido' => strtolower($request['ape']),
			'correo' => $this->e,
			'cedula' => $this->c,
			'fecha_ingreso' => $f
		], $this->table);

		$this->id = (int) $this->db->lastInsertId();

		$this->db->pInsert([
			'id_estado' => $request['estado'],
			'id_municipio' => $request['municipio'],
			'id_parroquia' => $request['parroquia'],
			'id_personal' => $this->id,
			'condicion' => 0,

		], 'solicitante');

		$pass = (new Password)->generate();
		$keyreg = md5(time());
		$this->db->pInsert([
			'id_personal' => $this->id,
			'usuario' => $this->e,
			'clave' => Str::bcrypt($pass),
			'keyreg' => $keyreg
		], 'usuarios');

		
		Fl::writeIntoFile('../../.data_info/date.log', "\n Usuario: $this->e - Contraseña: $pass - confirmar: ". URL . "confirm/cuenta/$keyreg/$this->id");
		return array('success' => true, 'msg' => 'Registrado con éxito');
	}

	public function __destruct() {
		parent::__destruct();
	}

}

?>