<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class FrontController extends Controllers{
    private $f;
    public function __construct(Front $f) {
        parent::__construct(true);
        $this->f = $f;
      
    }

    // -------------------------------------------------

    /**
     * Método principal index 
     */
    public function index(){
        echo $this->view->render('front/index',array(
            'admins' => $this->f->count_regs('usuarios', "rango='2'"),
            'empleados' => $this->f->count_regs('usuarios', "rango='1'"),
            'estados' => $this->f->count_regs('estado'),
            'municipios' => $this->f->count_regs('municipio'),
            'parroquias' => $this->f->count_regs('parroquia'),
            'grupos' => $this->f->count_regs('grupo'),
            'becas' => $this->f->count_regs('beca'),
            'solicitantes' => $this->f->count_regs('solicitante'),
            'entrevistas' => $this->f->count_regs('entrevista'),
            'solicitudes' => $this->f->count_regs('grupo_solicitante'),
        ));
    }
    // -------------------------------------------------
    
}
