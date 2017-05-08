<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Confirm extends Models{
	private $c;
	public function __construct(){
		parent::__construct();
		
	}

	
	final public function confirmar(){
		try {
			
			if (empty($this->args)) {
				throw new Exception(true);
				
			}
			$keyreg = $this->args[0];
			$id = (int) $this->args[1];
			if (false == $this->db->pSelect('id', 'usuarios', "id='$id' AND keyreg = '$keyreg' AND activo = '0'", 'LIMIT 1')) {
				throw new Exception(true);
			}

			$this->db->pUpdate([
				'activo' => 1,
				'keyreg' => ''
			], 'usuarios', "id='$id'");
		} catch (Exception $e) {
			Str::redir();
		}
	}
	

	public function __destruct() {
		parent::__destruct();
	}



}

?>
