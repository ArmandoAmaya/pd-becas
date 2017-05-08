<?php
// --------------------------------------------------------------
final class Val extends Twig_Extension{

	// --------------------------------------------------------------
	final public static function Hour(string $hour) : bool {
		return preg_match('/^[0-9]{2}:[0-9]{2}$/', $hour);
	}

	// --------------------------------------------------------------
	/**
	 * Comprueba que una url sea una "url"
	 * @param  string $url Cadena a evaluar
	 * @return true si la url tiene el formato que debe ser, false en caso contrario
	 */
	final public static function Url(string $url) : bool{
		return (bool) preg_match('#^(https?://|www\.)#i', $url);

	}

	// --------------------------------------------------------------

	 /**
     * Comprueba que una cadena no esté vacía
     *
     * @param string $c - Cadena a evaluar
     *
     * @return true si está vacía, false en caso contrario
     */

	final public static function Empty(string $c) : bool {
		return empty( trim( str_replace(' ', '', $c) ) );
	}
	// --------------------------------------------------------------


     /**
      * Comprueba que una cadena sea un email
      *
      * @param string $email - cadena a evaluar
      *
      * @return true si es email, false en caso contrario
      */

	final public static function Email(string $c) : bool{
		return filter_var($c, FILTER_VALIDATE_EMAIL);
	}
	// --------------------------------------------------------------

	/**
	 * Compruba que una cadena sea alfanumérica
	 *
	 * @param string $c - Cadena a evaluar
	 *
	 * @return true si es alfnumérica, false en caso contrario
	 */

	final public static function alphanum(string $c) : bool{
		return ctype_alnum($c);
	}

	// --------------------------------------------------------------

	/**
     * Comprueba que una cadena sea solo letras
     *
     * @param string $c - Cadena a evaluar
     *
     * @return true si solo es letra, false en caso contrario
     */

	final public static function Letters(string $c) : bool{
		return ctype_alpha( trim( str_replace(' ', '', $c) ) );
	}

	// --------------------------------------------------------------

	/**
     * Comprueba que todos los elementos de un arreglo esten llenos
     *
     * @param array $a - arreglo a evaluar
     *
     * @return true si no hay elementos vacíos, false en caso contrario
     */

	final public static function fullArray(array $a) : bool{

		foreach ($a as $el) {
			if (self::Empty($el)) {
				return false;
			}
		}

		return true;
	}

	// --------------------------------------------------------------

	/**
     * Comprueba que haya un elemento vacío pasado por parametro
     *
     * @return true si hay un elemento vacío, false en caso contrario
     *
     */

	final public static function oneEmpty() : bool{
		$args = func_num_args();
		for ($i=0; $i < $args ; $i++) {
			if (self::Empty( func_get_arg($i) ) && func_get_arg($i) != '0') {
				return true;
			}
		}

		return false;
	}

	// --------------------------------------------------------------

	/**
     * Comprueba que una imagen sea una imagen
     *
     * @param string|$image - Nombre de la imagen
     * 
     * @return true si es una imagen, false en caso contrario
     *
     */

	final public static function isImage(string $image) : bool{
		return (bool) in_array(Fl::fext($image), ['jpg', 'png', 'gif', 'jpeg', 'JPG', 'PNG', 'GIF','JPEG']);
	}

	// --------------------------------------------------------------
	/**
	 * Valida que un archivo sea de un tipo indicado
	 * @param string $file - archivo a evaluar
	 * @param array|array $comp - formatos permitidos
	 *
	 * @return true en caso de ser el archivo indicado, false en caso contrario
	 */
	final public static function isDocument(string $file, array $comp = ['docx', 'pdf']){
		return (bool) in_array(Fl::fext($file), $comp);
	}

	// --------------------------------------------------------------
	final public static function is_url(string $url) {

	}

	// -----------------------------------

	public function getFunctions() : array {
		return array(
			new Twig_Function('Url', array($this,'Url')),
			new Twig_Function('Empty', array($this,'Empty')),
			new Twig_Function('Email', array($this,'Email')),
			new Twig_Function('alphanum', array($this,'alphanum')),
			new Twig_Function('Letters', array($this,'Letters')),
			new Twig_Function('fullArray', array($this,'fullArray')),
			new Twig_Function('oneEmpty', array($this,'oneEmpty')),
			new Twig_Function('isImage', array($this,'isImage')),
			new Twig_Function('isDocument', array($this,'isDocument'))

		);
	}

	// -----------------------------------

	public function getName() : string {
		return 'Dev_Util_Val';
	}
}

?>
