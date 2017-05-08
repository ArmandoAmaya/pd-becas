<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class {{controller}} extends Controllers{
    public function __construct() {
        parent::__construct();
    }

    // -------------------------------------------------

    /**
     * Método principal index  
     * Se ejecuta por defecto al ingresar al controlador
     * Para enviar a una vista, ejecutar el código: 
     * echo $this->view->render('directorio/vista');
     */

    public function index(){
        //echo $this->view->render('directorio/vista');
    }
    
    // -------------------------------------------------
    
}
