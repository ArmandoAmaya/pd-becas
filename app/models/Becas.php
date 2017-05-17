<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Becas extends Models{

	public function __construct(){
		parent::__construct();
		
	}

	final public function get_becas(bool $one = false) {
		
		if (!$one) {
			return $this->db->pSelect('*', 'beca');
		}
		return $this->db->pSelect('*', 'beca', "id='$this->id'",'LIMIT 1');
		
	}
	

	public function __destruct() {
		parent::__destruct();
	}



}

?>
