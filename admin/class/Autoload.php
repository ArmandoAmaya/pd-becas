<?php
final class Autoload {

	// ------------------------------
	private static $ajax = AJAX ? '../' : 'app/';
	// ------------------------------

	final public function __construct() {
		self::models();
		self::utilities();
		self::class_autoload();
	}


	// ------------------------------

	/**
	 * Autocarga los modelos
	 *
	 * @return void
	 */

	final private function models() {
		spl_autoload_register(function(string $class){
			$ruta = self::$ajax . 'models/'.$class .'.php';
			if (file_exists($ruta)) {
				require($ruta);
			}
		});
	}

	// ------------------------------

	/**
	 * Autocarga las utilidades
	 *
	 * @return void;
	 */

	final private function utilities() {
		spl_autoload_register(function(string $class){
			$ruta = self::$ajax . 'utilities/'.$class .'.php';
			if (file_exists($ruta)) {
				require($ruta);
			}
		});
	}

	// ------------------------------

	/**
	 * Autocarga las clases generales del sistema
	 *
	 * @return void;
	 */

	final private function class_autoload(){
		spl_autoload_register(function(string $class){
			$ruta = (AJAX ? '../../' : '') . 'class/'.$class .'.php';
			if (file_exists($ruta)) {
				require($ruta);
			}
		});
	}
}


?>
