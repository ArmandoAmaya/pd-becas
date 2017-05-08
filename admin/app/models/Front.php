<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Front extends Models{

	public function __construct(){
		parent::__construct();
		
	}

	final public function count_regs(string $tabla, string $where = '1=1') {
		return $this->db->pSelect('count(id)', $tabla, $where,'LIMIT 1');
	}
	

	public function __destruct() {
		parent::__destruct();
	}



}

?>
