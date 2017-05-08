<?php
// --------------------------------------------------------------
final class Str extends Twig_Extension{

	


	// --------------------------------------------------------------
	/**
	 * Coloca la primera letra de nuna palabra en mayusculas y las demas en minusculas
	 * @param  string  $c - Cadena a evaluar
	 * @return String con la primera letra en mayusculas y estrictamente las demas en minusculas
	 */
	final public static function firstM(string $c) : string {
		return ucfirst( strtolower($c) );
	}

	// --------------------------------------------------------------


	/**
	 * Remueve los espacios de una cadena
	 *
	 * @param $c - cadena a evaluar
	 *
	 * @return devuelve el valor sin espacios
	 *
	 */

	final public static function no_spaces(string $c) : string {
		return trim( str_replace(' ', '', $c) );
	}

	// --------------------------------------------------------------

	/**
	 * Encripta una cadena
	 *
	 * @param string $cadena - Cadena a encriptar
	 *
	 * @return un hash de la cadena requerida
	 */

	final public static function bcrypt(string $c) : string{
		$salt =  substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22);
		$salt = strtr($salt, array('+' => '.'));
		return crypt($c, '$2y$10$'.$salt);
	}

	// --------------------------------------------------------------

	/**
	 * Compara una cadena con un hash
	 *
	 * @param string $c - Cadena a comparar
	 * @param string $comp - Hash con el que se quiere comparar
	 *
	 * @return true si coinciden, false en caso contrario
	 */

	final public static function ccrypt(string $c, string $comp) : bool{
		return crypt($c, $comp) == $comp;
	}

	// --------------------------------------------------------------

	/**
	 * Crea una url amigable a partir de un string
	 *
	 * @param string $slug - url a convertir
	 *
	 * @param un string convertido en url amigable
	 */


	final public static function slug(string $url){
		$url = strtolower($url);
		$url = str_replace(['á', 'é', 'í','ó','ú', 'ñ'],['a', 'e', 'i', 'o', 'u', 'n'], $url);
		$url = str_replace(['\n', '\r', '\n\r', '+', ' ', '%', '&'], '-', $url);

		return preg_replace(['/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/'], ['', '-', ''], $url);
	}

	// --------------------------------------------------------------

	/**
	 * Función para redireccionar una página
	 *
	 * @param string $ruta - Ruta a la que se quiere redireccionar
	 *
	 * @return void
	 */

	final public static function redir(string $url = ''){
		if (false !== strpos($url, 'http://') or false !== strpos($url,'https://')) {
			header('location: '.$url);
			exit;
		}

		header('location: '.URL.$url);
	}

	// -----------------------------------

	public function getFunctions() : array {
		return array(
			new Twig_Function('firstM', array($this,'firstM')),
			new Twig_Function('no_spaces', array($this,'no_spaces')),
			new Twig_Function('bcrypt', array($this,'bcrypt')),
			new Twig_Function('ccrypt', array($this,'ccrypt')),
			new Twig_Function('slug', array($this,'slug')),
			new Twig_Function('redir', array($this,'redir'))

		);
	}

	// -----------------------------------

	public function getName() : string {
		return 'Dev_Util_Str';
	}
}
?>
