<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------
class GruposController extends Controllers{
    private $g;
    public function __construct(Grupos $g) {
        parent::__construct();
        $this->g = $g;
    }

    // -------------------------------------------------

    /**
     * Método para enviar a la vista de los grupos
     */

    public function index(){
        echo $this->view->render('grupos/index',array(
            'grupos' => $this->g->grupos()
        ));
    }
}
