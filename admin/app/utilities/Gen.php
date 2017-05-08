<?php  
// -----------------------------------
final class Gen extends Twig_Extension{

	// -----------------------------------
	final public static function in_entr(int $id) : bool{
		$Ldb = new LinkDB;
		$id_entrevista = $Ldb->pSelect('id_entrevista', 'solicitante_entrevista', "id_solicitante='$id'", 'LIMIT 1')[0][0];
		$time_entr = $Ldb->pSelect('fecha,hora', 'entrevista', "id='$id_entrevista'");
		$time = time();

		if (false == $id_entrevista or false == $time_entr) {
			return false;
		}

		if ($time >= $time_entr[0][0]) {
			return true;
		}

		return false;

	}
	
	// -----------------------------------
	/**
	 * Convierte un json en un array
	 * @param string $json - Cadena JSON a evaluar
	 * @return array con los datos del JSON
	 */
	final public static function json_to_array(string $json) : array{
		return json_decode($json, true);
	}	

	// -----------------------------------
	
	/**
	 * Obtiene el thumbnail de una imagen
	 * 
	 * @param string|$dir - Directorio del thumb
	 * 
	 * @return un string con la dirección del thumbnail
	 */
	
	final public static function get_thumb(string $dir) : string{
		if (sizeof(glob($dir . 'thumb.*'))) {
			return glob($dir . 'thumb.*')[0];
		}
		return '../public/dev/images/default.png';
	}
	
	// -----------------------------------
	
	/**
	 * Obtiene los dias de la semana
	 * 
	 * @return arreglo con lso dias de la semana
	 */
	
	final public static function dias() : array {
		return [
			'Lunes',
			'Martes',
			'Miercoles',
			'Jueves',
			'Viernes',
			'Sabado',
			'Domingo'
		];
	}
	// -----------------------------------
	/**
	 * Obtiene un estilo de condición personalizado 
	 * @return Array con las scondiciones personalizadas
	 */
	final public static function get_cond() : array {
		
		return array(
			'<span style="padding:5px 10px;font-size:12px;" class="badge badge-pill badge-round badge-info"><i style="margin-right:5px" class="site-menu-icon wb-pencil" aria-hidden="true"></i>Creación </span>',
			'<span style="padding:5px 10px;font-size:12px;" class="badge badge-pill badge-round badge-warning"><i style="margin-right:5px" class="site-menu-icon wb-info-circle" aria-hidden="true"></i>Verificando </span>',
			'<span style="padding:5px 10px;font-size:12px;" class="badge badge-pill badge-round badge-default"><i style="margin-right:5px" class="site-menu-icon wb-clipboard" aria-hidden="true"></i>Entrevista </span>',
			'<span style="padding:5px 10px;font-size:12px;" class="badge badge-pill badge-round badge-primary"><i style="margin-right:5px" class="site-menu-icon wb-alert-circle" aria-hidden="true"></i>En espera </span>',
			'<span style="padding:5px 10px;font-size:12px;" class="badge badge-pill badge-round badge-danger"><i style="margin-right:5px" class="site-menu-icon wb-thumb-down" aria-hidden="true"></i>Rechazado </span>',
			'<span style="padding:5px 10px;font-size:12px;" class="badge badge-pill badge-round badge-success"><i style="margin-right:5px" class="site-menu-icon wb-thumb-up" aria-hidden="true"></i>Aprobado </span>'
		);
	}


	// -----------------------------------
	/**
	 * Coloca iconos de redes sociales
	 * @param string|string $fontsize - Tamaño del ícono
	 * @return array con los iconos de las redes sociales
	 */
	final public static function social_icons(string $fontsize = '24') : array {
		return array(
			'facebook' => '<i style="font-size:'.$fontsize.'px" class="icon bd-facebook" aria-hidden="true"></i>',
			'twitter' => '<i style="font-size:'.$fontsize.'px" class="icon bd-twitter" aria-hidden="true"></i>',
			'linkedin' => '<i style="font-size:'.$fontsize.'px" class="icon bd-linkedin" aria-hidden="true"></i>',
			'dribbble' => '<i style="font-size:'.$fontsize.'px" class="icon bd-dribbble" aria-hidden="true"></i>',
			'instagram' => '<i style="font-size:'.$fontsize.'px" class="icon bd-instagram" aria-hidden="true"></i>',
			'github' => '<i style="font-size:'.$fontsize.'px" class="icon bd-github" aria-hidden="true"></i>',
			'skype' => '<i style="font-size:'.$fontsize.'px" class="icon bd-skype" aria-hidden="true"></i>',
			'youtube' => '<i style="font-size:'.$fontsize.'px" class="icon bd-youtube" aria-hidden="true"></i>',
			'evernote' => '<i style="font-size:'.$fontsize.'px" class="icon bd-evernote" aria-hidden="true"></i>',
			'google-plus' => '<i style="font-size:'.$fontsize.'px" class="icon bd-google-plus" aria-hidden="true"></i>',
		);
	}

	// -----------------------------------
	/**
	 * Funcion de disponibilidad para plantilla de twig
	 * @return array con las funciones del objeto
	 */
	public function getFunctions() : array {
		return array(
			new Twig_Function('get_cond', array($this,'get_cond')),
			new Twig_Function('dias', array($this,'dias')),
			new Twig_Function('json_to_array', array($this,'json_to_array')),
			new Twig_Function('get_thumb', array($this,'get_thumb')),
			new Twig_Function('social_icons', array($this,'social_icons')),
			new Twig_Function('in_entr', array($this,'in_entr')),
		); 
	}

	// -----------------------------------
	/**
	 * Nombre personalizado como identificador para twig
	 * @return String con el nombre
	 */
	public function getName() : string {
		return 'Dev_Util_Gen';
	}
}

?>