class Password  {
	constructor(){
		this.tamano_password = 9;
		this.caracteres_conseguidos = 0;
		this.caracter_temporal = '';
		this.array_caracteres = [];

		for(let i = 0; i < this.tamano_password; i++){
			this.array_caracteres[i] = null;
		}

		this.caracter_definitivo = '';

		this.numero_minimo_letras_minusculas = 1;
		this.numero_minimo_letras_mayusculas = 1;
		this.numero_minimo_numeros = 1;
		this.numero_minimo_simbolos = 1;

		this.letras_minusculas_conseguidas = 0;
		this.letras_mayusculas_conseguidas = 0;
		this.numeros_conseguidos = 0;
		this.simbolos_conseguidos = 0;

	}

	genera_aleatorio(i_numero_inferior, i_numero_superior){
		let i_numero = Math.floor( (Math.random() * (i_numero_superior - i_numero_inferior + 1)) + i_numero_inferior);
		return i_numero;
	}

	genera_caracter(tipo_caracter){
		let lista_caracteres = '$+=?@_23456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz';
		let caracter_generado = '';
		let valor_superior = 0;
		let valor_inferior = 0;
		switch (tipo_caracter) {
			case 'minúscula':
				valor_inferior = 38;
				valor_superior = 61;
			break;
			case 'mayúscula':
				valor_inferior = 14;
				valor_superior = 37;
			break;
			case 'número':
				valor_inferior = 6;
				valor_superior = 13;
			break;
			case 'símbolo':
				valor_inferior = 0;
				valor_superior = 5;
			break;
			case 'aleatorio':
				valor_inferior = 0;
				valor_superior = 61;
			break;
			
		}
		caracter_generado = lista_caracteres.charAt( this.genera_aleatorio(valor_inferior,valor_superior) );
		return caracter_generado;
	}

	guardar_caracter_en_posicion_aleatoria(caracter_pasado_por_parametro){
		let guardar_en_posicion_vacia = false;
		let posicion_en_array = 0;

		while (true != guardar_en_posicion_vacia) {
			posicion_en_array = this.genera_aleatorio(0, this.tamano_password - 1);

			if (this.array_caracteres[posicion_en_array] == null) {
				this.array_caracteres[posicion_en_array] = caracter_pasado_por_parametro;
				guardar_en_posicion_vacia = true;
			}
		}
	}

	genera_contrasena(){
		while(this.letras_minusculas_conseguidas < this.numero_minimo_letras_minusculas){
			this.caracter_temporal = this.genera_caracter('minúscula');
			this.guardar_caracter_en_posicion_aleatoria(this.caracter_temporal);
			this.letras_minusculas_conseguidas++;
			this.caracteres_conseguidos++;
		}

		while(this.letras_mayusculas_conseguidas < this.numero_minimo_letras_mayusculas){
			this.caracter_temporal = this.genera_caracter('mayúscula');
			this.guardar_caracter_en_posicion_aleatoria(this.caracter_temporal);
			this.letras_mayusculas_conseguidas++;
			this.caracteres_conseguidos++;
		}

		while(this.numeros_conseguidos < this.numero_minimo_numeros){
			this.caracter_temporal = this.genera_caracter('número');
			this.guardar_caracter_en_posicion_aleatoria(this.caracter_temporal);
			this.numeros_conseguidos++;
			this.caracteres_conseguidos++;
		}

		while(this.simbolos_conseguidos < this.numero_minimo_simbolos){
			this.caracter_temporal = this.genera_caracter('símbolo');
			this.guardar_caracter_en_posicion_aleatoria(this.caracter_temporal);
			this.simbolos_conseguidos++;
			this.caracteres_conseguidos++;
		}

		while(this.caracteres_conseguidos < this.tamano_password){
			this.caracter_temporal = this.genera_caracter('aleatorio');
			this.guardar_caracter_en_posicion_aleatoria(this.caracter_temporal);
			this.caracteres_conseguidos++;
		}
	
		for (let i = 0; i < this.array_caracteres.length; i++) {
			this.caracter_definitivo += this.array_caracteres[i];
		}

		return this.caracter_definitivo;

	}

}

