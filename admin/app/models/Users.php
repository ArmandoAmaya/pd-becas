<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Users extends Models{
	
	public function __construct(){
		parent::__construct();
	}

	final public function get_user(int $id) : array{
		return $users = $this->db->pSelect('id,usuario,rango', 'usuarios', "id='$id'", 'LIMIT 1')[0];
	}

	

	public function __destruct() {
		parent::__destruct();
	}

}

?>