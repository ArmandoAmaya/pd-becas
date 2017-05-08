<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Solicitantes extends Models{
	private $e;
	private $dir = './public/dev/images/solicitantes/';
	private $id_personal;
	private $cupos;
	private $id_grupo;
	
	public function __construct(){
		parent::__construct();
		$this->table = 'solicitante';
	}

	# Sube un archivo
	final private function upload_file(string $dir, int $id, int $id_personal){
		if ($_FILES) {
			$dir = $this->dir . $id . '/';
			if (!is_dir('../../../' . $dir)) {
				mkdir('../../../' . $dir, true, 0777);
			}

			
			if (isset($_FILES['perfil'])) {
				if (sizeof($f = glob($dir. '{*.jpg,*.png,*.gif,*.jpeg,*.JPG,*.JPEG,*.PNG,*.GIF}', GLOB_BRACE)) > 0) {
					unlink($f[0]);
				}

				$this->uploader->thumb($_FILES['perfil']['tmp_name'], '../../../' . $dir . 'thumb', Fl::fext($_FILES['perfil']['name']), 300, 300);

				$this->img = $id . '.' . Fl::fext($_FILES['perfil']['name']);
				move_uploaded_file($_FILES['perfil']['tmp_name'], '../../../' . $dir . $this->img);

				$this->db->pUpdate(['perfil' => $dir . $this->img], 'personal', "id='$id_personal'");
			}


			if (isset($_FILES['c'])) {

				if (sizeof($f = glob($dir. '{*.pdf,*.docx}', GLOB_BRACE)) > 0) {
					unlink($f[0]);
				}

				$this->img = $id . '_curriculo_.'. Fl::fext($_FILES['c']['name']);
				move_uploaded_file($_FILES['c']['tmp_name'], '../../../' . $dir . $this->img);
				$this->db->pUpdate(['curriculo' => $dir . $this->img], $this->table, "id='$id'");
			}


		}
	}
 	
 	

	# Control de errores
	final private function Errors(array $request, bool $edit = false) {
		try {
			
			$this->e = strtolower($request['email']);

			if($edit) {
				$this->id = (int) $request['id'];
				$this->id_personal = (int) $this->db->pSelect('id_personal', $this->table, "id='$this->id'", 'LIMIT 1')[0][0];
				
				$where = "AND id <> '$this->id_personal'";

				if (Val::oneEmpty($request['email'])) {
					throw new Exception('Los campos con * son necesarios');
				}
			}else{
				$where = '';

				if (!Val::fullArray($request)) {
					throw new Exception('Los campos con * son necesarios');
				}
				
				if ($this->e != $request['emaildos']) {
					throw new Exception('Los correos no coinciden');
				}
				if ($request['pass'] != $request['passdos']) {
					throw new Exception('Las contraseñas no coinciden');
				}

				

			}
			
			
			
			$c = $request['ced'];

			if (false != $this->db->pSelect('id', 'personal', "(correo = '$this->e' OR cedula='$c') $where", 'LIMIT 1')) {
				throw new Exception('Este solicitante ya está registrado');
			}

			
			if (!Val::Email($this->e)) {
				throw new Exception('El correo debe tener un formato válido');
			}
			
			if (!is_numeric($request['ced']) or !is_numeric($request['tel1']) or !is_numeric($request['tel2'])) {
				throw new Exception('La cédula y los números de teléfonos deben ser numéricos');
			}
			if (!in_array($request['genero'], ['masculino', 'femenino'])) {
				throw new Exception('Debe seleccionar un género');
			}

			if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$request['fecha'])) {
				throw new Exception('La fecha debe tener un formato YYYY-MM-DD');
			}

			if (!in_array($request['estado'], array_keys(self::get_location('estado')))) {
				throw new Exception('Seleccione un Estado');
			}

			if (!in_array($request['municipio'], array_keys(self::get_location('municipio')))) {
				throw new Exception('Seleccione un Municipio');
			}
			if (!in_array($request['parroquia'], array_keys(self::get_location('parroquia')))) {
				throw new Exception('Seleccione una Parroquia');
			}
			if (!in_array($request['nacionalidad'], ['V','E'])) {
				throw new Exception('Nacionalidad inválida');
			}
			

			$this->uploader = new Uploader;

			if (isset($_FILES['perfil'])) {
				if ($_FILES['perfil']['size'] > (1024*1024)) {
					throw new Exception('La imagen no puede pesara mas de 1Mb.');
				}
				if (!Val::isImage( $_FILES['perfil']['name'] ) ) {
					throw new Exception('El archivo a subir debe ser una imagen.');
				}
			}
			if (isset($_FILES['c'])) {
				if (!Val::isDocument($_FILES['c']['name'])) {
					throw new Exception('El formato del currículo debe ser Word o PDF.');
				}
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
		
		$fn = strtotime($request['fecha']);
		$fr = time();
		

		$d = array(
			'nombre' => Str::firstM($request['nombre']),
			'apellido' => Str::firstM($request['apellido']),
			'cedula' => $request['ced'],
			'correo' => $this->e,
			'genero' => $request['genero'],
			'direccion' => $request['dir'],
			'telefono1' => $request['tel1'],
			'telefono2' => $request['tel2'],
			'fecha_nacimiento' => $fn,
			'fecha_ingreso' => $fr
		);
		$this->db->pInsert($d, 'personal');

		$id_personal = $this->db->lastInsertId();

		$pass = $request['pass'];

		$this->db->pInsert([
			'rango' => 0,
			'id_personal' => $id_personal,
			'usuario' => $this->e, 
			'clave' => Str::bcrypt($pass)
		], 'usuarios');

		$d = array(
			'id_estado' => $request['estado'],
			'id_municipio' => $request['municipio'],
			'id_parroquia' => $request['parroquia'],
			'nacionalidad' => $request['nacionalidad'],
			'id_personal' => $id_personal
		);
		$this->db->pInsert($d, $this->table);
		$this->id = $this->db->lastInsertId();

		
		$this->upload_file($this->dir, $this->id, $id_personal);

		$this->db->pInsert(['id_beca' => $request['beca'], 'id_solicitante' => $this->id], 'beca_solicitante');
		
		if (!file_exists('../../../date.log')) {
			Fl::writeFile('../../../date.log', "Usuario: $this->e - Contraseña: $pass \n");
		}else if (file_exists('../../../date.log')) {
			Fl::writeIntoFile('../../../date.log', "\n--------------------------------------------------------\n Usuario: $this->e - Contraseña: $pass");
		}
		

		return array(
			'success' => true, 
			'msg' => 'Registrado con éxito.', 
			'url' => 'solicitantes/edit/'.$this->id.'/'
		);
		
	}

	# Obtiene y convierte las redes sociales del solicitante en un json
	final private function redes_json(array $request) : string{

		$a = array();
		$social_label = json_decode($request['social_label']);
		
		# Si no hay elementos devolvemos una cadena vacía
		if (0 == sizeof($social_label)) {
			return '';

		#si sólo hay un elemento, no es necesario iterarlo
		}else if (sizeof($social_label) == 1) {
			$a[$social_label[0]] = $request[$social_label[0] . '_link'];
			return json_encode($a);
		}

		# En caso de haber mas de 1 elemento los iteramos
		foreach ($social_label as $s) {
			if (Val::Url($request[$s. '_link'])) {
				$a[$s] = $request[$s. '_link']; 
			}
		}
		
		# Devolvemos un json con los datos
		return json_encode($a);
		
	}

	# Edita un registro
	final public function Edit(array $request) {
		$error = $this->Errors($request,true);
		if (!is_bool($error)) {
			return $error;
		}
	
		$fn = strtotime($request['fecha']);
		$d = array(
			'nombre' => Str::firstM($request['nombre']),
			'apellido' => Str::firstM($request['apellido']),
			'cedula' => $request['ced'],
			'correo' => $this->e,
			'genero' => $request['genero'],
			'direccion' => $request['dir'],
			'telefono1' => $request['tel1'],
			'telefono2' => $request['tel2'],
			'fecha_nacimiento' => $fn,
		);
		$this->db->pUpdate($d, 'personal', "id='$this->id_personal'");
		$d = array(
			'usuario' => $this->e, 
		);
		if (!Val::Empty($request['pass'])) {
			$d['clave'] = Str::bcrypt($request['pass']);
		}
		$this->db->pUpdate($d, 'usuarios', "id_personal='$this->id_personal'");

		$d = array(
			'id_estado' => $request['estado'],
			'id_municipio' => $request['municipio'],
			'id_parroquia' => $request['parroquia'],
			'nacionalidad' => $request['nacionalidad'],
			'id_personal' => $this->id_personal,
			'redes_sociales' => $this->redes_json($request)
		);
		$this->db->pUpdate($d, $this->table, "id='$this->id'");

		
		$this->upload_file($this->dir, $this->id, $this->id_personal);

		$this->db->pUpdate(['id_beca' => $request['beca']], 'beca_solicitante', "id_solicitante='$this->id'");

		
		return array('success' => true, 'msg' => 'Editado con éxito. ');
	}
	# Errores al enviar la solicitud
	final private function solicitud_errors(array $request) {
		try {
			$this->id = (int) $request['id'];
			$this->id_grupo = (int) $request['grupo_id'];
			
			
			if (false != $this->db->pSelect('id', 'grupo_solicitante', "id_grupo = '$this->id_grupo' AND id_solicitante='$this->id'", 'LIMIT 1')) {
				throw new Exception('La solicitud ha sido enviada anteriormente');
			}
			if ('undefined' == $request['grupo_id']) {
				throw new Exception('Debe elegir un grupo antes de enviar la solicitud');
			}
			$this->cupos = $this->db->pSelect('cupos', 'grupo', "id='$this->id_grupo' AND cupos > 0", 'LIMIT 1');
			if (false == $this->cupos) {
				throw new Exception('Ya no hay cupos para este grupo');
			}
			if (Val::Empty($request['path'])) {
				throw new Exception('Debe tener un currículo subido antes de enviar la solicitud');
			}
			if ($request['beca_id'] <= 0) {
				throw new Exception('Debe tener una beca elegida antes de enviar la solicitud');
			}

			

			return false;
		} catch (Exception $e) {
			return array('success' => false, 'msg' => $e->getMessage());
		}
	}

	# Realiza una solicitud 
	final public function Solicitud(array $request){
		$error = $this->solicitud_errors($request);
		if (!is_bool($error)) {
			return $error;
		}
		$ts = time();
		$this->db->pUpdate([
			'tiempo_solicitud' => $ts,
			'condicion' => 1
		], $this->table, "id='$this->id'");

		$this->db->pInsert([
			'id_grupo' => $this->id_grupo,
			'id_solicitante' => $this->id
		],'grupo_solicitante');

		$this->db->pUpdate([
			'cupos' => $this->cupos[0][0] - 1
		], 'grupo', "id='$this->id_grupo'");

		return array('success' => true, 'msg' => 'Solicitud enviada.');
	}
	
	# Verifica si la solicitud fue enviad y devuelve el id del grupo
	final public function solicitud_enviada() {
		return $this->db->pSelect('id_grupo', 'grupo_solicitante', "id_solicitante='$this->id'", 'LIMIT 1');
	}

	# Obtiene un registro
	final public function read(bool $edit = false){
		if (!$edit) {
			return $this->db->pQuery("SELECT s.id, s.nacionalidad, p.nombre, p.apellido, p.correo,p.cedula FROM solicitante s INNER JOIN personal p ON s.id_personal = p.id", true)->fetchAll();
		}
		$solicitante = $this->db->pQuery("SELECT 
			s.id, 
			s.id_estado, 
			s.id_municipio, 
			s.id_parroquia, 
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
			INNER JOIN parroquia pa ON  s.id_parroquia = pa.id WHERE s.id = '$this->id' LIMIT 1", true)->fetchAll();
		$id_solicitante = $solicitante[0][0];
		$beca = $this->db->pSelect('id_beca', 'beca_solicitante', "id_solicitante = '$id_solicitante'", 'LIMIT 1');
		$solicitante[0]['id_beca'] = $beca[0][0];
		return $solicitante;                                                                                                                                                  
	}

	# Obtiene los paises
	final public function get_location(string $table, string $where = ''){
		return $this->select_array($this->db->pQuery("SELECT * FROM $table $where", true), $table);
	}


	# Obtiene la beca del solicitante
	final public function get_beca() {
		$beca_solicitante = $this->db->pSelect('id_beca', 'beca_solicitante', "id_solicitante = '$this->id'", 'LIMIT 1');
		if (false == $beca_solicitante) {
			return false;
		}
		$id = $beca_solicitante[0][0];
		return $this->db->pSelect('*', 'beca', "id='$id'", 'LIMIT 1');
	}

	

	# Obtiene los grupos de trabajo
	final public function get_grupos() {
		return $this->db->pSelect('*', 'grupo');
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
