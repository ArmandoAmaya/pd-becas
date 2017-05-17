<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Empleados extends Models{
	private $e;
	private $c;
	private $dir = './public/dev/images/empleados/';
	public function __construct(){
		parent::__construct();
		$this->table = 'personal';
	}

	

	# Control de errores
	final private function Errors(array $request, bool $edit = false) {
		try {
			

			if($edit) {

				if (Val::oneEmpty($request['name'], $request['ape'], $request['email'], $request['ced'], $request['tel'],$request['tel2'], str_replace('-', '', $request['fecha']), $request['dir'])) {
					throw new Exception('Los campos con <b>*</b> son necesarios.');
				}
				if (!Val::Email($request['email'])) {
					throw new Exception('El correo electrònico debe tener un formato vàlido.');
				}
				$this->id = (int) $request['id'];
				$where = "AND id <> '$this->id'";
				
			}else{

				if (!Val::fullArray($request)) {
					throw new Exception('Los campos con <b>*</b> son necesarios.');
				}

				if (!Val::Email($request['email']) or !Val::Email($request['emaildos'])) {
					throw new Exception('El correo electrònico debe tener un formato vàlido.');
				}

				if ($request['email'] != $request['emaildos']) {
					throw new Exception('Los correos no coinciden.');
				}

				if ($request['pass'] != $request['passdos']) {
					throw new Exception('Las contraseñas no coinciden.');
				}

				

				$where = '';
			}
			$this->uploader = new Uploader;
			
			$this->e = strtolower($request['email']);
			$this->c = (int) $request['ced'];

			if (false != $this->db->pSelect('id', $this->table, "(correo='$this->e' OR cedula='$this->c') $where", 'LIMIT 1')) {
				throw new Exception('Este usuario ya esta registrado en el sistema.');
			}


			if (!Val::Letters($request['name']) or !Val::Letters($request['ape'])) {
				throw new Exception('El nombre y apellido solo deben contener letras.');
			}
			
			if (!is_numeric($request['ced'])) {
				throw new Exception('El número de cédula solo debe contener números.');
			}

			if (!in_array($request['gen'], ['masculino', 'femenino'])) {
				throw new Exception('Debe seleccionar un género.');
			}
			if (!is_numeric($request['tel']) or !is_numeric($request['tel2'])) {
				throw new Exception('Los números de teléfono solo debe contener números.');
			}
			if ((strlen($request['tel']) < 10 or strlen($request['tel']) > 11) or (strlen($request['tel2']) < 10 or strlen($request['tel2']) > 11)) {
				throw new Exception('Los números de teléfono solo deben contener 10 dígitos como mínimo y 11 dígitos como máximo.');
			}
			if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$request['fecha'])) {
				throw new Exception('La fecha debe tener un formato YYYY-MM-DD');
			}

			if ($_FILES) {
				if ($_FILES['perfil']['size'] > (1024*1024)) {
					throw new Exception('La imagen no puede pesara mas de 1Mb.');
				}
				if (!Val::isImage($_FILES['perfil']['name'])) {
					throw new Exception('La foto de perfil debe ser una imagen.');
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
		
		$f = strtotime($request['fecha']);
		$reg = time();
		$d = array(
			'nombre' => $request['name'],
			'apellido' => $request['ape'],
			'cedula' => $this->c,
			'correo' => $this->e,
			'genero' => $request['gen'],
			'fecha_ingreso' => $reg,
			'direccion' => $request['dir'],
			'telefono1' => $request['tel'],
			'telefono2' => $request['tel2'],
			'fecha_nacimiento' => $f
		);

		$this->db->pInsert($d, $this->table);
		
		$this->id = $this->db->lastInsertId();

		$u = array (
			'rango' => 1,
			'id_personal' => (int) $this->id,
			'usuario' => $this->e,
			'clave' => Str::bcrypt($request['pass']),
			'activo' => 1
		);

		$this->db->pInsert($u, 'usuarios');
		
		$this->upload_img($this->dir, $this->id);

		return array('success' => true, 'msg' => 'Registrado con éxito.');
	}

	# Edita un registro
	final public function Edit(array $request) {
		$error = $this->Errors($request,true);
		if (!is_bool($error)) {
			return $error;
		}
		$f = strtotime($request['fecha']);
		$d = array(
			'nombre' => $request['name'],
			'apellido' => $request['ape'],
			'cedula' => $this->c,
			'correo' => $this->e,
			'genero' => $request['gen'],
			'direccion' => $request['dir'],
			'telefono1' => $request['tel'],
			'telefono2' => $request['tel2'],
			'fecha_nacimiento' => $f
		);
		$this->db->pUpdate($d, $this->table, "id='$this->id'");
		
		$u = array (
			'usuario' => $this->e,
		);


		if (!Val::Empty($request['pass'])) {
			$u['clave'] = Str::bcrypt($request['pass']);
		}

		$this->db->pUpdate($u,'usuarios', "id_personal='$this->id'");

		$this->upload_img($this->dir, $this->id);

		return array('success' => true, 'msg' => 'Editado con éxito.');
	}

	

	# Obtiene un registro
	final public function read(bool $edit = false){
		if (!$edit) {
			$users = $this->db->pSelect('id_personal', 'usuarios', "rango='1'");
			if (false == $users) {
				return $users;
			}
			$prepare = $this->db->prepare("SELECT id,nombre,apellido,correo,perfil FROM $this->table WHERE id = ? ");
			foreach ($users as $user) {
				$prepare->execute(array($user['id_personal']));
				$personal = $prepare->fetch();

				$real_admin[] = array(
					'id' => $personal['id'],
					'nombre' => $personal['nombre'],
					'apellido' => $personal['apellido'],
					'correo' => $personal['correo'],
					'perfil' => $personal['perfil']
				);
			}

			return $real_admin;
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
