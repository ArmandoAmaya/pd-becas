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
			if (false === ($this->user = $this->db->pSelect('id,clave,rango', 'usuarios', "usuario='$this->u' AND (rango='2' OR rango='1') AND activo = '1'", 'LIMIT 1')) || !Str::ccrypt($request['pass'],$this->user[0]['clave'])) {
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
		$_SESSION['rango'] = $this->user[0][2];

		if (isset($request['remmeber'])) {
			$lifetime = (24*24*60);
			ini_set('session.cache_expire', $lifetime);
			ini_set('session.cache_limiter', 'none');
			ini_set('session.cookie_lifetime', $lifetime);
			ini_set('session.gc_maxlifetime', $lifetime); 
		}
		

		return array('success' => true, 'msg' => 'Te estamos redireccionando....');
	}

	public function __destruct() {
		parent::__destruct();
	}

}

?>