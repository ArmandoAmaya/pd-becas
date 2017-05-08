<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class SolicitudesController extends Controllers{

    private $s;

    public function __construct(Solicitudes $s) {
        parent::__construct(true);
        $this->s = $s;
        
    }

    // -------------------------------------------------
    
    /**
    * Método principal se ejecuta por defecto al acceder al controlador
    * Generalmente utilizado para leer registros
    */

    public function index(){
        
        echo $this->view->render('solicitudes/index',array(
            'data' => $this->s->read("(condicion = '1' OR condicion = '2')"),
            'entrevistas' => $this->s->get_entrevistas(),
            'aprobados' => $this->s->read_list(5),
            'espera' => $this->s->read_list(3),
            'rechazados' => $this->s->read_list(4)   
        ));
    }

    // -------------------------------------------------

    /**
    * Método para vista de añadir registros
    * Despliega la vista para añadir registros
    */

    public function add() {
    	echo $this->view->render('solicitudes/add');
    }

    // -------------------------------------------------
    
    /**
    * Método para editar registros
    * Despliega la vista para editar un único registro
    * Es necesario enviar un campo para identificar al registro
    */

    public function edit() {
        if($this->id && false != ($item = $this->s->read(true))){
            echo $this->view->render('solicitudes/edit',array(
                'data' => $item[0]
            ));
        }else{
            Str::redir('solicitudes/');
        }
    	
    }

}
