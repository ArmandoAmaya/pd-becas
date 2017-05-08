<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class {{controller}} extends Controllers{
    private ${{varname}};
    public function __construct({{model}} ${{varname}}) { 
        parent::__construct();
        $this->{{varname}} = ${{varname}};
    }

    // ------------------------------------------------
    
    /**
     * Método privado para capturar el mensaje enviado por el modelo
     */
    
    private function catchMessage() : string{
    	if (isset($_GET['error'])) {
    		return 'Mensaje de error';    		
    	}else if (isset($_GET['success']) && true == $_GET['success']) {
    		return 'Mensaje de éxito';
    	}

    	return '';
    }

    // -------------------------------------------------
    
    /**
     * Método index - método principal 
     * Se ejecuta por defecto al acceder al controlador
     * ¿ Que hace este método ? generalmente utilizado para leer los registros
     */
    
    public function index(){
        echo $this->view->render('{{view}}/index', array('data' => $this->{{varname}}->read()));
    }

    // -------------------------------------------------

    /**
     * Método add - método para agregar registros
     * Si hay una petición post, el formulario fue enviado y ejecutamos el método para agregar
     * Si no hay petició post, solo se renderea la vista
     */

    public function add() {
    	if ($_POST) {
    		$this->{{varname}}->add($_POST);
    	}
        echo $this->view->render('{{view}}/add', array('msg' => $this->catchMessage()));
    }

    // -------------------------------------------------

    /**
     * Método edit - método para editar registros
     * Es necesario enviar el id u otro campo para identificar el registro
     * Si hay petición post se ejecuta el método, sino solo rendereamos la vista
     */

    public function edit(int $id){
    	if ($_POST) {
    		$this->{{varname}}->editar($_POST);
    	}
    	echo $this->view->render('{{view}}/edit', array(
    		'msg' => $this->catchMessage(),
    		'data' => $this->{{varname}}->read(true)[0]

    	));
    }

    // -------------------------------------------------

    /**
     * Método delete - método para eliminar registos
     * Es necesario enviar el id u otro campo para identificar el registro
     */

    public function delete(int $id){
    	$this->{{varname}}->delete($id);
    }
}
