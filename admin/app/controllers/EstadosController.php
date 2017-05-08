<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class EstadosController extends Controllers{

    private $e;

    public function __construct(Estados $e) {
        parent::__construct(true);
        $this->e = $e;
    }

    // -------------------------------------------------
    
    /**
    * Método principal se ejecuta por defecto al acceder al controlador
    * Generalmente utilizado para leer registros
    */

    public function index(){
        
        echo $this->view->render('estados/index',array('data' => $this->e->read()));
    }

    // -------------------------------------------------

    /**
    * Método para vista de añadir registros
    * Despliega la vista para añadir registros
    */

    public function add() {
    	echo $this->view->render('estados/add');
    }

    // -------------------------------------------------
    
    /**
    * Método para editar registros
    * Despliega la vista para editar un único registro
    * Es necesario enviar un campo para identificar al registro
    */

    public function edit(int $id) {
        
    	echo $this->view->render('estados/edit',array(
            'data' => $this->e->read(true)[0]
        ));
    }

    
}
