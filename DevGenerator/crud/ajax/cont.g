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

    // -------------------------------------------------
    
    /**
    * Método principal se ejecuta por defecto al acceder al controlador
    * Generalmente utilizado para leer registros
    */

    public function index(){
        
        echo $this->view->render('{{view}}/index',array('data' => $this->{{varname}}->read()));
    }

    // -------------------------------------------------

    /**
    * Método para vista de añadir registros
    * Despliega la vista para añadir registros
    */

    public function add() {
    	echo $this->view->render('{{view}}/add');
    }

    // -------------------------------------------------
    
    /**
    * Método para editar registros
    * Despliega la vista para editar un único registro
    * Es necesario enviar un campo para identificar al registro
    */

    public function edit() {
        if($this->id && false != ($item = $this->{{varname}}->read(true))){
            echo $this->view->render('{{view}}/edit',array(
                'data' => $item[0]
            ));
        }else{
            Str::redir('{{view}}/');
        }
    	
    }

}
