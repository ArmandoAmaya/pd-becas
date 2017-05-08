<?php  
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class SolicitantesController extends Controllers{

    private $s;

    public function __construct(Solicitantes $s) {
        parent::__construct(true);
        $this->s = $s;
        
        
    }

    // -------------------------------------------------
    
    /**
    * Método principal se ejecuta por defecto al acceder al controlador
    * Generalmente utilizado para leer registros
    */

    public function index(){
        
        echo $this->view->render('solicitantes/index',array('data' => $this->s->read()));
    }

    // -------------------------------------------------

    /**
    * Método para vista de añadir registros
    * Despliega la vista para añadir registros
    */

    public function add() {
    	echo $this->view->render('solicitantes/add',array(
            'estados' => $this->s->get_location('estado'),
            'becas' => $this->s->get_location('beca')
        ));
    }

    // -------------------------------------------------
    
    /**
    * Método para editar registros
    * Despliega la vista para editar un único registro
    * Es necesario enviar un campo para identificar al registro
    */

    public function edit() {
        if($this->id && false != ($item = $this->s->read(true))){
            echo $this->view->render('solicitantes/edit',array(
                'data' => $item[0],
                'estados' => $this->s->get_location('estado'),
                'becas' => $this->s->get_location('beca'),
            ));
        }else{
            Str::redir('solicitantes/');
        }
    	
    }

    // -------------------------------------------------
    
    /**
    * Método para ver perfil de un unico solicitante
    * Despliega la vista para ver un único registro
    * Es necesario enviar un campo para identificar al registro
    */

    public function perfil(){
        if($this->id && false != ($item = $this->s->read(true))){
            echo $this->view->render('solicitantes/perfil',array(
                'data' => $item[0],
                'beca' => $this->s->get_beca()[0],
                'grupos' => $this->s->get_grupos(),
                'solicitud' => $this->s->solicitud_enviada()
            ));
        }else{
            Str::redir('solicitantes/');
        }
    }

    // -------------------------------------------------
    
    /**
    * Método para descargar un currículo
    * 
    */

    public function download(){
        if ($this->id and file_exists($path = '../'.$_POST['path'])) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($path).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($path));
            readfile($path);
            exit;
        }else{
            Str::redir('solicitantes/');
        }
    }

}