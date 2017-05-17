<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class ParroquiasController extends Controllers{

    private $p;

    public function __construct(Parroquias $p) {
        parent::__construct(true,true);
        $this->p = $p;
    }

    // -------------------------------------------------
    
    /**
    * Método principal se ejecuta por defecto al acceder al controlador
    * Generalmente utilizado para leer registros
    */

    public function index(){
        
        echo $this->view->render('parroquias/index',array('data' => $this->p->read()));
    }

    // -------------------------------------------------

    /**
    * Método para vista de añadir registros
    * Despliega la vista para añadir registros
    */

    public function add() {
    	echo $this->view->render('parroquias/add',array(
            'parroquias' => $this->p->get_mu()
        ));
    }

    // -------------------------------------------------
    
    /**
    * Método para editar registros
    * Despliega la vista para editar un único registro
    * Es necesario enviar un campo para identificar al registro
    */

    public function edit() {
        if($this->id && false != ($item = $this->p->read(true))){
            echo $this->view->render('parroquias/edit',array(
                'data' => $item[0],
                'municipios' => $this->p->get_mu()
            ));
        }else{
            Str::redir('parroquias/');
        }
    	
    }

}
