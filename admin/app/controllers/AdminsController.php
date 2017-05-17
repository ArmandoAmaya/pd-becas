<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class AdminsController extends Controllers{
    private $data;
    public function __construct(Admins $a) {
        parent::__construct(true,true);
        $this->data = $a;
       
    }

    // -------------------------------------------------
    
    /**
    * Método principal se ejecuta por defecto al acceder al controlador
    * Generalmente utilizado para leer registros
    */

    public function index(){
        echo $this->view->render('admins/index', array('data' => $this->data->read()));
    }

    // -------------------------------------------------

    /**
    * Método para vista de añadir registros
    * Despliega la vista para añadir registros
    */

    public function add() {
        echo $this->view->render('admins/add');
    }

    // -------------------------------------------------
    
    /**
    * Método para editar registros
    * Despliega la vista para editar un único registro
    * Es necesario enviar un campo para identificar al registro
    */

    public function edit(int $id) {
        if ($this->id and false != ($item = $this->data->read(true))) {
           echo $this->view->render('admins/edit', array(
                'data' => $item[0]
            ));
        }else{
            Str::redir('admins/');
        }
        
    }

    
}
