<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Grupos extends Models{

	public function __construct(){
		parent::__construct();
		
	}

	
	final public function grupos() {
		return $this->db->pSelect('*', 'grupo');
	}

	public function __destruct() {
		parent::__destruct();
	}



}

?>
