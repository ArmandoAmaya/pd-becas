<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Perfil extends Models{

	private $e;
	private $c;
	private $dir = './public/dev/images/solicitantes/';
	private $user;
	public function __construct(){
		parent::__construct();
	}

	# Sube un archivo
	final private function upload_file(string $dir, int $id, int $id_personal){
		if ($_FILES) {
			$dir = $this->dir . $id . '/';
			if (!is_dir('../../' . $dir)) {
				mkdir('../../' . $dir, true, 0777);
			}

			
			if (isset($_FILES['perfil'])) {
				if (sizeof($f = glob($dir. '{*.jpg,*.png,*.gif,*.jpeg,*.JPG,*.JPEG,*.PNG,*.GIF}', GLOB_BRACE)) > 0) {
					unlink($f[0]);
				}

				$this->uploader->thumb($_FILES['perfil']['tmp_name'], '../../' . $dir . 'thumb', Fl::fext($_FILES['perfil']['name']), 300, 300);

				$this->img = $id . '.' . Fl::fext($_FILES['perfil']['name']);
				move_uploaded_file($_FILES['perfil']['tmp_name'], '../../' . $dir . $this->img);

				$this->db->pUpdate(['perfil' => $dir . $this->img], 'personal', "id='$id_personal'");
			}


			if (isset($_FILES['c'])) {

				if (sizeof($f = glob($dir. '{*.pdf,*.docx}', GLOB_BRACE)) > 0) {
					unlink($f[0]);
				}

				$this->img = $id . '_curriculo_.'. Fl::fext($_FILES['c']['name']);
				move_uploaded_file($_FILES['c']['tmp_name'], '../../' . $dir . $this->img);
				$this->db->pUpdate(['curriculo' => $dir . $this->img], 'solicitante', "id='$id'");
			}


		}
	}
	

	final public function get_user(int $id, bool $perfil = false) : array{

		if ($perfil) {
			return $this->db->pQuery("SELECT 
			s.id,
			s.id_estado,
			s.id_municipio,
			s.id_parroquia,
			s.condicion,
			s.nacionalidad,
			s.curriculo,
			s.redes_sociales,
			s.tiempo_solicitud,
			e.estado,
			m.municipio,
			pa.parroquia,
			p.nombre,
			p.apellido,
			p.correo,
			p.cedula,
			p.genero,
			p.direccion,
			p.telefono1,
			p.telefono2,
			p.fecha_nacimiento,
			p.fecha_ingreso,
			p.perfil
			FROM solicitante s
			INNER JOIN personal p ON s.id_personal = p.id 
			INNER JOIN estado e ON s.id_estado = e.id 
			INNER JOIN municipio m ON s.id_municipio = m.id 
			INNER JOIN parroquia pa ON s.id_parroquia = pa.id 
			WHERE s.id_personal = '$id' LIMIT 1
		",true)->fetch();

		}
		return $this->db->pSelect('id,nombre,perfil', 'personal', "id='$id'", 'LIMIT 1')[0];
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

	final private function errors(array $request) {
		try {
			$this->e = $request['email'];
			$this->c = (int) $request['ced'];

			if (false != $this->db->pSelect('id', 'personal', "(correo = '$this->e' OR cedula='$this->c') AND id <> '$this->user_id'", 'LIMIT 1')) {
				throw new Exception('Este usuario ya está registrado');
			}

			if (Val::oneEmpty($request['email'],$request['ced'],$request['nombre'],$request['apellido'],$request['genero'],$request['tel1'],$request['fecha'],$request['dir'])) {
				throw new Exception('Los campos con * son necesarios');
			}

			if (!Val::Email($this->e)) {
				throw new Exception('El correo debe tener un formato válido');
			}
			
			if (!is_numeric($request['ced']) or !is_numeric($request['tel1']) or (!Val::Empty($request['tel2']) and !is_numeric($request['tel2']))) {
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
	final public function Edit(array $request){
		$error = $this->errors($request);
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
		$this->db->pUpdate($d, 'personal', "id='$this->user_id'");

		$d = array('usuario' => $this->e);
		if (!Val::Empty($request['pass'])) {
			$d['clave'] = Str::bcrypt($request['pass']);
		}
		$this->db->pUpdate($d, 'usuarios', "id_personal='$this->user_id'");

		$d = array(
			'id_estado' => $request['estado'],
			'id_municipio' => $request['municipio'],
			'id_parroquia' => $request['parroquia'],
			'nacionalidad' => $request['nacionalidad'],
			'redes_sociales' => $this->redes_json($request)
		);
		$this->db->pUpdate($d, 'solicitante', "id_personal='$this->user_id'");

		$this->id = (int) ($this->db->pSelect('id', 'solicitante', "id_personal='$this->user_id'", 'LIMIT 1')[0][0]);
		
		$this->upload_file($this->dir, $this->id, $this->user_id);

		return array('success' => true, 'msg' => 'Perfil exitado.');
	}

	final public function pendiente(int $id, string $tabla) : bool {
		if (false != $this->db->pSelect('id_solicitante', $tabla, "id_solicitante='$id'", 'LIMIT 1')) {
			return false;
		}
		return true;
	}

	final public function get_reg(string $campos, string $tabla) {
		return $this->db->pSelect($campos, $tabla);
	}

	final public function get_location(string $table, string $where = ''){
		return $this->select_array($this->db->pQuery("SELECT * FROM $table $where", true), $table);
	}

	final public function is_owner() : bool {
		$this->user = $this->db->pSelect('rango,id_personal', 'usuarios', "id_personal='$this->user_id'", 'LIMIT 1');
		if ($this->user[0][0] == '2' or $this->user[0][1] == $this->user_id) {
			return true;
		}

		return false;
	}

	final public function Solicitud(array $request){
		try {

			$id_solicitante = (int) $this->db->pSelect('id', 'solicitante', "id_personal='$this->user_id'", 'LIMIT 1')[0][0];
			$id_grupo = (int) $request['id_grupo'];
			$id_beca = (int) $request['id_beca'];

			$grupo_list = array_keys(self::get_location('grupo'));
			$beca_list = array_keys(self::get_location('beca'));

			if (!self::pendiente($id_solicitante,'grupo_solicitante')) {
				throw new Exception('Ya has enviado la solicitud');
			}

			if (!self::pendiente($id_solicitante,'beca_solicitante')) {
				throw new Exception('Ya has escogido una beca');
			}

			if (!in_array($id_beca, $beca_list)) {
				throw new Exception('Debes Seleccionar una beca');
			}

			if (!in_array($id_grupo, $grupo_list)) {
				throw new Exception('Debes Seleccionar un grupo');
			}

			if (Val::Empty($request['curriculo'])) {
				throw new Exception('Debes subir tu currículo para poder enviara la solicitud');
			}

			$t = time();
			$this->db->pUpdate([
				'condicion' => 1,
				'tiempo_solicitud' => $t
			], 'solicitante', "id='$id_solicitante'");

			$this->db->pInsert([
				'id_beca' => $id_beca,
				'id_solicitante' => $id_solicitante
			],'beca_solicitante');

			$this->db->pInsert([
				'id_grupo' => $id_beca,
				'id_solicitante' => $id_solicitante
			],'grupo_solicitante');

			$this->db->pQuery("UPDATE grupo SET cupos = cupos - '1' WHERE id = '$id_grupo' LIMIT 1",true);

			return array('success' => true, 'msg' => 'Solicitud enviada con éxito.');
		} catch (Exception $e) {
			return array('success' => false, 'msg' => $e->getMessage());
		}
		
	}

	final public function get_beca() {
		$id_solicitante = $this->db->pSelect('id', 'solicitante', "id_personal = '$this->user_id'", 'LIMIT 1')[0][0];
		return $this->db->pQuery("SELECT b.beca,b.tipo,b.sede,b.perfil FROM beca_solicitante bs INNER JOIN beca b ON bs.id_beca = b.id WHERE bs.id_solicitante = '$id_solicitante' LIMIT 1",true)->fetch();
	}

	final public function get_grupo() {
		$id_solicitante = $this->db->pSelect('id', 'solicitante', "id_personal = '$this->user_id'", 'LIMIT 1')[0][0];
		return $this->db->pQuery("SELECT g.grupo,g.cupos,g.hora_entrada,g.hora_salida,g.formato FROM grupo_solicitante gs INNER JOIN grupo g ON gs.id_grupo = g.id WHERE gs.id_solicitante = '$id_solicitante' LIMIT 1",true)->fetch();
	}

	final public function get_entrevista() {
		$id_solicitante = $this->db->pSelect('id', 'solicitante', "id_personal = '$this->user_id'", 'LIMIT 1')[0][0];
		return $this->db->pQuery("SELECT e.titulo,e.fecha,e.hora,e.lugar FROM solicitante_entrevista se INNER JOIN entrevista e ON se.id_entrevista = e.id WHERE se.id_solicitante = '$id_solicitante' LIMIT 1",true)->fetch();
	}



	public function __destruct() {
		parent::__destruct();
	}

}

?>