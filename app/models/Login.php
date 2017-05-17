<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Login extends Models{
	private $u;
	private $user;
	public function __construct(){
		parent::__construct();
	}

	final private function Errors(array $request) {
		try {

			if (!Val::Email($request['email'])) {
				throw new Exception('El email debe tener un formato válido.');
			}

			$this->u = $request['email'];
			$this->user = $this->db->pSelect('id,clave,activo,rango', "usuarios", "usuario='$this->u' AND rango = '0'", 'LIMIT 1');
			if (false == $this->user or !Str::ccrypt($request['password'], $this->user[0]['clave'])) {
				throw new Exception('Credenciales incorrectas.');
			}

			if (0 == $this->user[0]['activo']) {
				throw new Exception('Debes confirmar tu cuenta para poder ingresar.');
			}
			
			return false;
		} catch (Exception $e) {
			return array('success' => false, 'msg' => $e->getMessage());
		}
	}

	final public function SignIn(array $request){
		$error = $this->Errors($request);
		if (!is_bool($error)) {
			return $error;
		}

		$_SESSION[SESSION_ID] = $this->user[0][0]; 
		$_SESSION['rango'] = $this->user[0]['rango'];

		if ($_SESSION['rango'] > 1) {
			return array('success' => true, 'msg' => 'Te estamos redireccionando...', 'url' => URL . 'admin/');
		}

		return array('success' => true, 'msg' => 'Te estamos redireccionando...', 'url' => '');
	}

	

	public function __destruct() {
		parent::__destruct();
	}

}

?>