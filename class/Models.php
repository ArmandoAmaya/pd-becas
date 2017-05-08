<?php
// ---------------------------------------

defined('INDEX') or die('No estas en index');

// ---------------------------------------

abstract class Models {

	// ---------------------------------------

	protected $db;
	protected $id;
	protected $args;
	protected $user_id;
	protected $table = '';
	protected $fill = [];

	protected $uploader;
	protected $img;

	

	// ---------------------------------------

	/**
	 * Constructor - Modelos abstractos
	 * 
	 * @return void;
	 */

	protected function __construct(string $dbname = DATABASE['dbname'], string $driver = DATABASE['driver'], bool $new = false) {

		global $request;

		$this->db = LinkDB::Connect($dbname, $driver, $new);

		$this->user_id = $_SESSION[SESSION_ID] ?? 0;

		$this->id = ( array_key_exists(0, $request->_getargs()) && is_numeric($request->_getargs()[0]) && $request->_getargs()[0] >= 1 ) ? (int) $request->_getargs()[0] : 0;

		$this->args = sizeof($request->_getargs()) > 1 ? $request->_getargs() : array();
	}


	// ---------------------------------------

	/**
	 * Lenna los campos para ser guardados en una tabla
	 */

	protected function fill(array $request) : array {
		if (sizeof($this->fill) != sizeof($request)) {
			return array();
		}
		return array_combine($this->fill, $request);
	}

	// ---------------------------------------
	/**
	 * Inserta los elementos llenos en una tabla
	 */
	protected function fillInsert(array $request) {
		if (null == $this->fill($request)) {
			return false;
		}
		return $this->db->insert($this->fill($request), $this->table);
	}

	// ---------------------------------------

	/**
	 * Encuentro un registro por el id
	 */

	protected function findById(int $id, string $table = '', string $limit = 'LIMIT 1') : array {

		$tab = Func::emp($table) ? $this->table : $table;

		if (false != ($r = $this->db->pSelect('*', $tab, "id='$id'", $limit) ) ) {
			return $r;
		}
		

		return array();
	}

	// ---------------------------------------
	protected function select_array(PDOStatement $query, string $col = '') : array {
		$a = array();

		if (!Val::Empty($col)) {
			foreach ($query as $q) {
				$a[$q['id']] = array_key_exists($col, $q) ? $q[$col] : null;
			}
		}else {
			foreach ($query as $q) {
				$a[$q['id']] = $q;
			}
		}

		
		return $a;

	}

	// ---------------------------------------
	protected function upload_img(string $dir, int $id, bool $thumb = true, string $table = null, string $fn = 'perfil', string $campo = 'perfil'){

		if ($_FILES) {

			$t = null == $table ? $this->table : $table;

			$dir = $dir . $id . '/';
			if (!is_dir('../../../'.$dir)) {
				mkdir('../../../'.$dir, 0777,true);
			}

			if (sizeof(Fl::fspath('../../../' . $dir)) > 0) {
				Fl::rDir('../../../' . $dir, true);
			}

			
			if ($thumb) {
				$this->uploader->thumb($_FILES[$fn]['tmp_name'], '../../../'.$dir . 'thumb', Fl::fext($_FILES[$fn]['name']));
			}
			
			$this->img = $id . '.' . Fl::fext($_FILES[$fn]['name']);

			move_uploaded_file($_FILES[$fn]['tmp_name'], '../../../'. $dir . $this->img);

			$this->db->pUpdate([$campo => $dir . $this->img], $t, "id='$id'");

		}
	}


	// ---------------------------------------

	/**
	 * Destructor - Libera la conexión
	 * 
	 * @return void;
	 */
	protected function __destruct() {
		$this->db = null;
	}

}


?>