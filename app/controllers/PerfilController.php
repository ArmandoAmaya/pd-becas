<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------
class PerfilController extends Controllers{
    private $p;
    public function __construct(Perfil $p) {
        # Solo accesible por usuarios no logeados
        parent::__construct(true);
        $this->p = $p;
        
    }

    // -------------------------------------------------

    /**
     * Método - Vista principal del Perfil
     */

    public function index(){

        echo $this->view->render('perfil/index', array(
            'pend' => $this->p->pendiente($this->id_solicitante, 'grupo_solicitante'),
            'bcsol' => $this->p->pendiente($this->id_solicitante, 'beca_solicitante'),
            'grupos' => $this->p->get_reg('id,grupo', 'grupo'),
            'becas' => $this->p->get_reg('id,beca,perfil', 'beca'),
            'gs' => $this->p->get_grupo(),
            'bs' => $this->p->get_beca(),
            'se' => $this->p->get_entrevista()
        ));
    }

    // -------------------------------------------------

    /**
     * Método - Vista editar del Perfil
     */

    public function editar(){

        if ($this->p->is_owner()) {
           echo $this->view->render('perfil/editar',array(
                'estados' => $this->p->get_location('estado'),
                'municipios' => $this->p->get_location('municipio'),
                'parroquias' => $this->p->get_location('parroquia'),
            ));
        }else{
            Str::redir();
        }
        
    }

    // -------------------------------------------------

    /**
     * Método - Vista para enviar solicitud
     */

    public function solicitud(){

        if ($this->p->is_owner()) {
            echo $this->view->render('perfil/solicitud',array(
                'becas' => $this->p->get_location('beca'),
                'grupos' => $this->p->get_location('grupo'),
                'pend' => $this->p->pendiente($this->id_solicitante, 'grupo_solicitante'),
            ));
        }else{
            Str::redir();
        }
        
    }
}
