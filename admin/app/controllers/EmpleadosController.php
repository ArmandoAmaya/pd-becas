<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class EmpleadosController extends Controllers{

    private $e;

    public function __construct(Empleados $e) {
        parent::__construct(true);
        $this->e = $e;
    }

    // -------------------------------------------------
    
    /**
    * Método principal se ejecuta por defecto al acceder al controlador
    * Generalmente utilizado para leer registros
    */

    public function index(){
        
        echo $this->view->render('empleados/index',array('data' => $this->e->read()));
    }

    // -------------------------------------------------

    /**
    * Método para vista de añadir registros
    * Despliega la vista para añadir registros
    */

    public function add() {
    	echo $this->view->render('empleados/add');
    }

    // -------------------------------------------------
    
    /**
    * Método para editar registros
    * Despliega la vista para editar un único registro
    * Es necesario enviar un campo para identificar al registro
    */

    public function edit() {
        if($this->id && false != ($item = $this->e->read(true))){
            echo $this->view->render('empleados/edit',array(
                'data' => $item[0]
            ));
        }else{
            Str::redir('empleados/');
        }
    	
    }

}
