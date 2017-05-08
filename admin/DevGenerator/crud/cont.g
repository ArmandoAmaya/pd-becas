<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class {{controller}} extends Controllers{
    
    /**
    * Recomendación: Crear modelo con el mismo nombre que el controlador y pasar clase por inyección de dependencias por constructor
    * @example - public function __construct(Test $test), llamandose el controlador TestContoller
    *
    * Nota: para que esto funcione "SI O SI" el controlador y el modelo deben tener el mismo nombre
    * @example - Controlador: TestContoller, Modelo: Test
    */
    public function __construct() { 
        parent::__construct();
        
    }

    // ------------------------------------------------
    
    /**
     * Método privado para capturar el mensaje enviado por el modelo
     * (Descomentar si se utilizará, sino eliminar método)
     */
    
    /*private function catchMessage() : string{
    	if (isset($_GET['error'])) {
    		return 'Mensaje de error';    		
    	}else if (isset($_GET['success']) && true == $_GET['success']) {
    		return 'Mensaje de éxito';
    	}

    	return '';
    }*/

    // -------------------------------------------------
    
    /**
     * Método index - método principal 
     * Se ejecuta por defecto al acceder al controlador
     * ¿ Que hace este método ? generalmente utilizado para leer los registros
     */
    
    public function index(){
        // Código para leer
    }

    // -------------------------------------------------

    /**
     * Método add - método para agregar registros
     * Si hay una petición post, el formulario fue enviado y ejecutamos el método para agregar
     * Si no hay petició post, solo se renderea la vista
     */

    public function add() {
    	// Código para agregar
    }

    // -------------------------------------------------

    /**
     * Método edit - método para editar registros
     * Es necesario enviar el id u otro campo para identificar el registro
     * Si hay petición post se ejecuta el método, sino solo rendereamos la vista
     */

    public function edit(int $id){
    	// Código para editar
    }

    // -------------------------------------------------

    /**
     * Método delete - método para eliminar registos
     * Es necesario enviar el id u otro campo para identificar el registro
     */

    public function delete(int $id){
    	// Código para eliminar
    }
}
