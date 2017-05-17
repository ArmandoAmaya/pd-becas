<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class MunicipiosController extends Controllers{

    private $m;

    public function __construct(Municipios $m) {
        parent::__construct(true,true);
        $this->m = $m;

    }

    // -------------------------------------------------
    
    /**
    * Método principal se ejecuta por defecto al acceder al controlador
    * Generalmente utilizado para leer registros
    */

    public function index(){
        
        echo $this->view->render('municipios/index',array(
            'data' => $this->m->read(),
            'estados' => $this->m->get_es()
        ));
    }

    // -------------------------------------------------

    /**
    * Método para vista de añadir registros
    * Despliega la vista para añadir registros
    */

    public function add() {
    	echo $this->view->render('municipios/add',array(
            'estados' => $this->m->get_es()
        ));
    }

    // -------------------------------------------------
    
    /**
    * Método para editar registros
    * Despliega la vista para editar un único registro
    * Es necesario enviar un campo para identificar al registro
    */

    public function edit() {
        if ($this-> id && false != ($item = $this->m->read(true))) {

            echo $this->view->render('municipios/edit',array(
                'data' => $item[0],
                'estados' => $this->m->get_es()
            ));
        }else{
            Str::redir('municipios/');
        }
    	
    }

}
