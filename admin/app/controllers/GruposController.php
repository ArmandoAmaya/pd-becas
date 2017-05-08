<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class GruposController extends Controllers{

    private $g;
    public function __construct(Grupos $g) {
        parent::__construct(true);
        $this->g = $g;

    }

    // -------------------------------------------------
    
    /**
    * Método principal se ejecuta por defecto al acceder al controlador
    * Generalmente utilizado para leer registros
    */

    public function index(){
        
        echo $this->view->render('grupos/index',array('data' => $this->g->read()));
    }

    // -------------------------------------------------

    /**
    * Método para vista de añadir registros
    * Despliega la vista para añadir registros
    */

    public function add() {
    	echo $this->view->render('grupos/add');
    }

    // -------------------------------------------------
    
    /**
    * Método para editar registros
    * Despliega la vista para editar un único registro
    * Es necesario enviar un campo para identificar al registro
    */

    public function edit() {
        if($this->id && false != ($item = $this->g->read(true))){
            echo $this->view->render('grupos/edit',array(
                'data' => $item[0]
            ));
        }else{
            Str::redir('grupos/');
        }
    	
    }

}
