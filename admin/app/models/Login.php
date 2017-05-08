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
			if (false === ($this->user = $this->db->pSelect('id,clave', 'usuarios', "usuario='$this->u' AND (rango='2' OR rango='1')", 'LIMIT 1')) || !Str::ccrypt($request['pass'],$this->user[0]['clave'])) {
				throw new Exception('Credenciales incorrectas.');
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

		return array('success' => true, 'msg' => 'Te estamos redireccionando....');
	}

	public function __destruct() {
		parent::__destruct();
	}

}

?>