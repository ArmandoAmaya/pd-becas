<?php  
// -----------------------------------
final class Fl extends Twig_Extension{

	// -----------------------------------

	/**
	 * Devuelve la extension de un archivo
	 * 
	 * @param string $n - Archivo a evaluar
	 * 
	 * @return la exntesion del archivo
	 */

	final public static function fext(string $n) : string {
		return pathinfo($n, PATHINFO_EXTENSION);
	}

	// -----------------------------------

	/**
	 * Crea un arreglo secuencial con los archivos en sus directorios
	 * 
	 * @param string $dir - Directorio en el que se quiere buscar
	 * 
	 * @param string|string $type - Tipo de archivo
	 * 
	 * @return un arreglo con los archivos y sus diretorios
	 */

	final public static function fspath(string $dir, string $type = '') : array {
		$a = array();
		if (is_dir($dir)) {
			foreach (glob($dir . '*' . $type) as $f) {
				$a[] = $f;
			}
		}

		return $a;
	}
	// -----------------------------------

	/**
	 * Crea un diretorio
	 * 
	 * @param string $dir - Directorio a crear
	 * @param int $permisos - tipo de permisos para el directorio
	 * 
	 * @return true si se creó el directorio, false en caso contrario
	 */


	final public static function mDir(string $dir, int $permisos = 0777) : bool{
		if (is_dir($dir)) {
			return false;
		}

		return (bool) mkdir($dir, $permisos, true);
	}

	// -----------------------------------

	/**
	 * Remueve un archivode un directorio
	 * 
	 * @param string $file - Archivo a borrar
	 * 
	 * @return true si fue borrado, false en caso contrario
	 */

	final public static function rFile(string $file) : bool {
		if (file_exists($dir)) {
			unlink($dir);
			return true;
		}

		return false;
	}

	// -----------------------------------

	/**
	 *  Elimina un directorio de forma recursiva
	 * 
	 * @param string $dir - Directorio a eliminar
	 * @param bool $clear - Pasar true si solo se quiere vaciar el directorio sin borrarlo
	 * 
	 * @return void
	 */

	final public static function rDir(string $dir, bool $clear = false){
		if (!file_exists($dir)) {
			rmdir($dir);
		}else if (!is_dir($dir)) {
			throw new \RuntimeException($dir. ' No es un directorio.');
		}

		if (!is_link($dir)) {
			
			foreach (scandir($dir) as $f) {
				if ($f === '.' || $f === '..') {
					continue;
				}
				
				$direct = $dir . '/' . $f;
				
				if (is_dir($direct)) {
					self::rDir($direct);
				}else if( !unlink($direct) ){
					throw new \RuntimeException('Fallo al borrar el archivo');;
				}

			}

			if (!$clear) {
				rmdir($dir);
			}
			 

		}

	}

	// -----------------------------------

	/**
	 * Mueve uno o varios archivos de un directorio a otro
	 * 
	 * @param string $new_dir - Nuevo directorio al que se desea mover
	 * @param strng $olddir - Directorio en donde están los archivos
	 * @param bool $img - true si solo se desean tomar imagenes
	 * @param bool $delete - true si se desean borrar los archivos del directorio del cual se copió
	 * @param bool $del_dir - true si se desea borrar el directorio antiguo completo
	 * 
	 * @return void 
	 * 
	 */

	final public static function moveToDir(string $new_dir, string $olddir, bool $img = false, bool $del_dir = false, bool $delete = false) {
		self::mDir($new_dir);

		foreach (glob($olddir. ( $img ? '{*.jpg,*.png, *.gif, *.jpeg, *.JPG, *.PNG, *.GIF, *.JPEG}' : '*' ), GLOB_BRACE ) as $file ) {
			$name = explode('/', $file);
			$name = end($name);

			if (file_exists($new_dir . $name)) {
				unlink($new_dir . $name);
			}

			copy($file, $new_dir . $name);
			!$delete ?: unlink($file);

			if (!$delete && $del_dir) {
				self::rDir($file);
			}
		}
	}

	// -----------------------------------

	/**
	 * Sube un archivo a un directorio
	 * 
	 * @param string $file - archivo a subir
	 * @param string $tmp_file - Carpeta temporal del archivo
	 * @param string $dir - directorio al que se desea mover
	 * @param bool $sobrescribir - true si se desea que se sobrescriba el archivo en caso de que ya exista este en el directorio
	 * 
	 * @return true si se subio el archivo correctamnete, false en caso contrario
	 */
	
	final public static function uploadFile(string $file, string $tmp_file, string $dir, bool $sobrescribir = false) : bool{
		if (move_uploaded_file($tmp_file,  (file_exists($dir . $file) && !$sobrescribir) ? ($dir . time() . $file) : $dir . $file )) {
			return true;
		}

		return false;
	}

	// -----------------------------------

	/**
	 * Escribe un archivo 
	 * 
	 * @param string $file - Archivo a crear 
	 * @param string $content - Contenido a insertar
	 * 
	 * @return el peso en bytes del archivo
	 */

	final public static function writeFile(string $file, string $content) : int{
		$file = new SplFileObject($file, 'w');
		return (int) $file->fwrite($content);
	}

	// -----------------------------------

	/**
	 * Escribe sobre un archivo
	 * @param string $file - archivo a escribir
	 * @param string $content - contenido a insertar
	 * @return el peso en bytes
	 */

	final public static function writeIntoFile(string $file, string $content) : int {
		$file = new SplFileObject($file, 'a+');
		return (int) $file->fwrite("\n----------------------------------------------\n".$content);
	}
	// -----------------------------------

	/**
	 * Lee un archivo
	 * @param string $dir - directorio del archivo
	 * @return string con el contenido del archivo
	 */

	final public static function readFile(string $dir) : string {
		
		$file = new SplFileObject($dir);
		$c = '';
		
		while (!$file->eof()) {
			$c .= $file->fgets();
		}

		return (string) $c;
		
	}

	// -----------------------------------

	public function getFunctions() : array {
		return array(
			new Twig_Function('fext', array($this,'fext')),
			new Twig_Function('fspath', array($this,'fspath')),
			new Twig_Function('mDir', array($this,'mDir')),
			new Twig_Function('rFile', array($this,'rFile')),
			new Twig_Function('rDir', array($this,'rDir')),
			new Twig_Function('moveToDir', array($this,'moveToDir')),
			new Twig_Function('uploadFile', array($this,'uploadFile')),
			new Twig_Function('writeFile', array($this,'writeFile')),
			new Twig_Function('writeIntoFile', array($this,'writeIntoFile')),
			new Twig_Function('readFile', array($this,'readFile'))

		);
	}

	// -----------------------------------

	public function getName() : string {
		return 'Dev_Util_Fl';
	}
}



?>