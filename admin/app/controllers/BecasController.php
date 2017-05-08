<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class BecasController extends Controllers{

    private $b;

    public function __construct(Becas $b) {
        parent::__construct(true);
        $this->b = $b;
    }

    // -------------------------------------------------
    
    /**
    * Método principal se ejecuta por defecto al acceder al controlador
    * Generalmente utilizado para leer registros
    */

    public function index(){
        
        echo $this->view->render('becas/index',array('data' => $this->b->read()));
    }

    // -------------------------------------------------

    /**
    * Método para vista de añadir registros
    * Despliega la vista para añadir registros
    */

    public function add() {
    	echo $this->view->render('becas/add');
    }

    // -------------------------------------------------
    
    /**
    * Método para editar registros
    * Despliega la vista para editar un único registro
    * Es necesario enviar un campo para identificar al registro
    */

    public function edit() {
        if($this->id && false != ($item = $this->b->read(true))){
            echo $this->view->render('becas/edit',array(
                'data' => $item[0]
            ));
        }else{
            Str::redir('becas/');
        }
    	
    }

}
