<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------
class ConfirmController extends Controllers{
    private $c;
    public function __construct(Confirm $c) {
        # Solo accesible por usuarios no logeados
        parent::__construct();
        $this->c = $c;
    }

    // -------------------------------------------------

    /**
     * Método - Vista principal del login
     */

    public function cuenta(){
        echo $this->view->render('confirmar/index',array(
            'confirmar' => $this->c->confirmar()
        ));
    }
}
