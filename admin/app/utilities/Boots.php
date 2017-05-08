<?php
// --------------------------------------------------------------

final class Boots extends Twig_Extension{

	// --------------------------------------------------------------

	/**
	 * Genera un input simple de bootstrap - doc http://getbootstrap.com/css/#forms-controls
	 *
	 * @param string $type - Tipo de input
	 * @param string $name - Nombre del input y tambien se coloca en el id más la palabra -Id
	 * @param string $value - Contenido del input
	 * @param string $plc - Placeholder del input
	 * @param stirng $clases - Clases adicionales a las que ya trae el input
	 * @param bool $req - Si es true coloca el atributo required en el input
	 *
	 * @return Un input simple de bootstrap
	 */

	final public static function input(string $type, string $name, string $plc = '',bool $requir = false, string $val = '',  string $class = '') : string{
		return "<input type=\"$type\" name=\"$name\" id=\"$name-Id\" value=\"$val\" class=\"form-control $class\" placeholder=\"$plc\" ".($requir ? 'required' : '').">";
	}

	// --------------------------------------------------------------

	/**
	 * Genera un textarea de bootstrap - doc http://getbootstrap.com/css/#forms-controls
	 *
	 * @param string $name - Nombre del textarea y tambien se coloca en el id más la palabra -Id
	 * @param string $value - Contenido del textarea
	 * @param string $plc - Placeholder del textarea
	 * @param string $class - Clases adicionales que puede tener le textarea
	 * @param int $rows - Número de filas que ocupará el textarea
	 * @param int $cols - Número de columnas que ocupará el textarea
	 *
	 * @return Un textarea de bootstrap
	 */

	final public static function textarea(string $name,string $plc = '', string $val = '', string $class = '', int $rows = null, int $cols = null) : string{
		return "<textarea name=\"$name\" id=\"$name-Id\" placeholder=\"$plc\" class=\"form-control $class\" cols=\"$cols\" rows=\"$rows\">$val</textarea>";
	}

	// --------------------------------------------------------------

	/**
	 * Genera un radio button de bootstrap - doc doc http://getbootstrap.com/css/#forms-controls
	 *
	 * @param string $name - Nombre del radio y tambien se coloca en el id más la palabra -Id
	 * @param string $value - Valor del radio button
	 * @param string $cont - Contenido del radio button
	 * @param string $class - Clases adicionales del radio
	 * @param bool $check - Si es true coloca el atributo checked en el radio
	 *
	 * @return Un radio button de bootstrap
	 */

	final public static function radio(string $name, string $value, string $cont = '', string $class = '', bool $check = false) : string {
		return "<div class=\"radio $class\">
				  	<label>
				  	  <input type=\"radio\" name=\"$name\" id=\"$name-Id\" value=\"$value\" ".(!$check ? '' : 'checked').">
				  	  $cont
				  	</label>
				</div>";
	}

	// --------------------------------------------------------------

	/**
	 * Genera un input tipo checkbox de bootstrap - doc http://getbootstrap.com/css/#forms-controls
	 *
	 * @param string $name - Nombre del checkbox y tambien se le coloca en el id más la palabra -Id
	 * @param string $value - Valor del checkbox
	 * @param string $cont - Contenido que tendrá el checkbox
	 * @param string $class - Clases extras para el checkbox
	 * @param bool $inline - Si es true genera un checkbox en linea, sino genera uno en bloque
	 * @param bool $check - Si es true le coloca el atributo checked al checkbox
	 *
	 * @return Un input tipo checkbox de bootstrap
	 */
	final public static function checkbox(string $name, string $value, string $cont = '', string $class = '', bool $inline = false, bool $check = false) : string{
		if (!$inline) {
			return "<div class=\"checkbox\">
				  	<label>
				  	  	<input type=\"checkbox\" name=\"$name\" value=\"$value\" id=\"$name-Id\" ".(!$check ? '' : 'checked').">
				  	  	$cont
				  	</label>
				</div>";
		}

		return "<label class=\"checkbox-inline\">
				  	<input type=\"checkbox\" name=\"$name\" value=\"$value\" id=\"$name-Id\" ".(!$check ? '' : 'checked').">
				  	  	$cont
				</label>";

	}

	// --------------------------------------------------------------

	/**
	 * Genera un input de selección de bootstrap - doc http://getbootstrap.com/css/#forms-controls
	 *
	 * @param string $name - Nombre del input de selección y tambien se le coloca en el id más la palabra -Id
	 * @param array $opt - Opciones que van dentro del input
	 * @param $selected - Selecciona una o varias opciones por defecto
	 * @param bool $multiple - Si es true coloca el input en tipo multiple
	 * @param string $plc - Coloca una opcion introductoria en el select (Ejemplo: "Seleccione una opción")
	 * @param string $class - Clases extras para el input
	 *
	 * @return Un input de selección de bootstrap
	 */
	final public static function select_input(string $name, array $opciones, $selected = '', bool $multiple = false, string $plc = null,string $class ='') : string {
		$op = '';

		if (is_array($selected)) {
			foreach ($opciones as $c => $opcion) {
				$op .= '<option value="'.$c.'" '.(in_array($c, $selected) ? 'selected' : '').'>'.$opcion.'</option>';
			}
		}else{
			foreach ($opciones as $c => $opcion) {
				$op .= '<option value="'.$c.'" '.($selected == $c ? 'selected' : '').'>'.$opcion.'</option>';
			}
		}


		return '<select name="'.$name.''.($multiple ? '[]' : '').'"  id="'.$name.'-Id" class="form-control '.$class.'" '.($multiple ? 'multiple' : '').'>
			'.(null != $plc ? '<option>'.$plc.'</option>' : '' ).'
			'.$op.'
		</select>';
	}
	// --------------------------------------------------------------

	/**
	 * Genera un botón dropdwon de bootstrap - doc http://getbootstrap.com/components/#btn-dropdowns
	 *
	 * @param string $title - Título del botón
	 * @param array $opt - links dentro del botón
	 * @param string $btn - Tipo de botón que puede ser: primary, danger, warning, info y default
	 *
	 * @return Un botón tipo dropdown
	 */

	final public static function dropdown_button(string $title, array $opt, string $btn = 'default', string $css = '') : string{
		$op = '';

		foreach ($opt as $c => $v) {
			$op .= '<li><a href="'.$c.'">'.$v.'</a></li>';
		}
		return '<div class="btn-group '.$css.'">
					<button type="button" class="btn btn-'.$btn.' dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    '.$title.' <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						'.$op.'
					</ul>
				</div>';
	}

	// --------------------------------------------------------------

	/**
	 * Genera un dropdown de bootstrap - doc http://getbootstrap.com/javascript/#dropdowns
	 *
	 * @param string $title - Título que llevará el botón
	 * @param array $opt - Links que estan dentro del botón
	 * @param string $btn - Tipo de botón, lista: primary, danger, warning, info y default
	 * @param bool $dropup - Si es true la orientación del botón cambia hacia arriba
	 * @param string $class - Clases adicionales
	 *
	 * @return Un dropdown de bootstrap
	 */

	final public static function dropdown(string $title, array $opt, string $btn = 'default', bool $dropup = false, string $class = '') : string {

		$op = '';
		foreach ($opt as $c => $v) {
			$op .= '<li><a href="'.$v.'">'.$v.'</a></li>';
		}

		return '<div class="'.(!$dropup ? 'dropdown' : 'dropup').' '.$class.'">
				  <button class="btn btn-'.$btn.' dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				    '.$title.'
				    <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				    '.$op.'
				  </ul>
				</div>';
	}

	// --------------------------------------------------------------

	/**
	 * Genera un conjunto de input select para una fecha de nacimiento
	 *
	 * @param int $ini - Desde que año comienza
	 * @param int $fin - Hasta que año termina
	 *
	 * @param array $plc - Arreglo con mensaje introductorio para cada input en orden [año, mes, dia]
	 * @example array $plc - array('Seleccione Año', 'Seleccione Mes', 'Seleccione Dia')
	 *
	 * @param array $selected - Arreglo con los el año, mes, dia seleccionado
	 * @example array $seleted  - ['1995', '05', '03']
	 *
	 * @return Un conjunto de input select para determinar una fecha de nacimiento
	 */

	final public static function birthdate(int $ini, int $fin, array $plc = array(), array $selected = array()){

		if (sizeof($plc) > 3 or sizeof($selected) > 3) {
			trigger_error('Los arreglos pasados como tercer y cuarto parámetro en esta función deben tener máximo 3 elementos', E_USER_ERROR);
		}

		$años = array();
		$i = $ini;
		do{
			$años[$i] = $i;
			++$i;
		}
		while ($i <= $fin);

		$año_selected = array_key_exists(0, $selected) ? $selected[0] : null;
		$año_plc = array_key_exists(0, $plc) ? $plc[0] : null;
		$select = '<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
						'.self::select_input('year', $años, $año_selected, false, $año_plc).'
					</div>';


		$mes_selected = array_key_exists(1, $selected) ? $selected[1] : null;
		$mes_plc = array_key_exists(1, $plc) ? $plc[1] : null;
		$select .= '<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
						'.self::select_input('month', array(
							'01' => 'Enero',
							'02' => 'Febrero',
							'03' => 'Marzo',
							'04' => 'Abril',
							'05' => 'Mayo',
							'06' => 'Junio',
							'07' => 'Julio',
							'08' => 'Agosto',
							'09' => 'Septiembre',
							'10' => 'Octubre',
							'11' => 'Noviembre',
							'12' => 'Diciembre'
						), $mes_selected, false, $mes_plc).'
					</div>';

		$dia_selected = array_key_exists(2, $selected) ? $selected[2] : null;
		$dia_plc = array_key_exists(2, $plc) ? $plc[2] : null;
		$select .= '<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
						'.self::select_input('day', array(
							'01' => '01',
							'02' => '02',
							'03' => '03',
							'04' => '04',
							'05' => '05',
							'06' => '06',
							'07' => '07',
							'08' => '08',
							'09' => '09',
							'10' => '10',
							'11' => '11',
							'12' => '12',
							'13' => '13',
							'14' => '14',
							'15' => '15',
							'16' => '16',
							'17' => '17',
							'18' => '18',
							'19' => '19',
							'20' => '20',
							'21' => '21',
							'22' => '22',
							'23' => '23',
							'24' => '24',
							'25' => '25',
							'26' => '26',
							'27' => '27',
							'28' => '28',
							'29' => '29',
							'30' => '30',
							'31' => '31'
						), $dia_selected, false, $dia_plc).'
					</div>';


		return $select;
	}


	// --------------------------------------------------------------
	public function getFunctions() : array {
		return array(
			new Twig_Function('input', array($this,'input')),
			new Twig_Function('textarea', array($this,'textarea')),
			new Twig_Function('radio', array($this,'radio')),
			new Twig_Function('checkbox', array($this,'checkbox')),
			new Twig_Function('select_input', array($this,'select_input')),
			new Twig_Function('dropdown_button', array($this,'dropdown_button')),
			new Twig_Function('dropdown', array($this,'dropdown')),
			new Twig_Function('birthdate', array($this,'birthdate'))
		);
	}

	// --------------------------------------------------------------
	public function getName() : string {
		return 'Dev_Util_Boots';
	}

}

?>
