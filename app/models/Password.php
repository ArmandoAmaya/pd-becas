<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

final class Password extends Models{
	private $t_pass = 9;
	private $caracteres_conseguidos = 0;
	private $caracter_temporal = '';
	private $array_caracteres = [];
	private $caracter_definitivo = '';
	private $numero_minimo_letras_minusculas = 1;
	private $numero_minimo_letras_mayusculas = 1;
	private $numero_minimo_numeros = 1;
	private $numero_minimo_simbolos = 1;
	private $letras_minusculas_conseguidas = 0;
	private $letras_mayusculas_conseguidas = 0;
	private $numeros_conseguidos = 0;
	private $simbolos_conseguidos = 0;

	final public function __construct(){
		parent::__construct();
	}

	final public function generate() : string{
		for ($i=0; $i < $this->t_pass; $i++) { 
			$this->array_caracteres[$i] = null;
		}
		return (string) $this->genera_contrasena();
	}

	final private function genera_caracter(string $tipo_caracter) : string {
		$lista_caracteres = '$+=?@_23456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz';
		$valor_inferior = 0;
		$valor_superior = 0;

		switch ($tipo_caracter) {
			case 'minúscula':
				$valor_inferior = 38;
				$valor_superior = 61;
			break;
			case 'mayúscula':
				$valor_inferior = 14;
				$valor_superior = 37;
			break;
			case 'número':
				$valor_inferior = 6;
				$valor_superior = 13;
			break;
			case 'símbolo':
				$valor_inferior = 0;
				$valor_superior = 5;
			break;
			case 'aleatorio':
				$valor_inferior = 0;
				$valor_superior = 61;
			break;
		}

		$caracter_generado = $lista_caracteres[random_int($valor_inferior, $valor_superior)];
		return $caracter_generado;
	}
	
	final private function guardar_caracter_en_posicion_aleatoria($caracter_pasado_por_parametro) {
		$guardar_en_posicion_vacia = false;
		$posicion_en_array = 0;

		while (true != $guardar_en_posicion_vacia) {
			$posicion_en_array = random_int(0, $this->t_pass - 1);
			if (null == $this->array_caracteres[$posicion_en_array]) {
				$this->array_caracteres[$posicion_en_array] = $caracter_pasado_por_parametro;
				$guardar_en_posicion_vacia = true;
			}
		}
	}

	final private function genera_contrasena() : string{

		while ($this->letras_minusculas_conseguidas < $this->numero_minimo_letras_minusculas) {
			$this->caracter_temporal = $this->genera_caracter('minúscula');
			$this->guardar_caracter_en_posicion_aleatoria($this->caracter_temporal);
			$this->letras_minusculas_conseguidas++;
			$this->caracteres_conseguidos++;
		}

		while ($this->letras_mayusculas_conseguidas < $this->numero_minimo_letras_mayusculas) {
			$this->caracter_temporal = $this->genera_caracter('mayúscula');
			$this->guardar_caracter_en_posicion_aleatoria($this->caracter_temporal);
			$this->letras_mayusculas_conseguidas++;
			$this->caracteres_conseguidos++;
		}

		while ($this->numeros_conseguidos < $this->numero_minimo_numeros) {
			$this->caracter_temporal = $this->genera_caracter('número');
			$this->guardar_caracter_en_posicion_aleatoria($this->caracter_temporal);
			$this->numeros_conseguidos++;
			$this->caracteres_conseguidos++;
		}

		while ($this->simbolos_conseguidos < $this->numero_minimo_simbolos) {
			$this->caracter_temporal = $this->genera_caracter('símbolo');
			$this->guardar_caracter_en_posicion_aleatoria($this->caracter_temporal);
			$this->simbolos_conseguidos++;
			$this->caracteres_conseguidos++;
		}

		while ($this->caracteres_conseguidos < $this->t_pass) {
			$this->caracter_temporal = $this->genera_caracter('aleatorio');
			$this->guardar_caracter_en_posicion_aleatoria($this->caracter_temporal);
			$this->caracteres_conseguidos++;
		}

		foreach ($this->array_caracteres as $caracter) {
			$this->caracter_definitivo .= $caracter;
		}

		return $this->caracter_definitivo;
	}

	final public function __destruct() {
		parent::__destruct();
	}

}

?>