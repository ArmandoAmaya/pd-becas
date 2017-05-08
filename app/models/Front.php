<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Front extends Models{
	private $s;
	public function __construct(){
		parent::__construct();
		
	}

	# Obtiene los paises
	final public function get_location(string $table, string $where = ''){
		return $this->select_array($this->db->pQuery("SELECT * FROM $table $where", true), $table);
	}
	

	public function __destruct() {
		parent::__destruct();
	}



}

?>
