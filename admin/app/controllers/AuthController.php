<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------
class AuthController extends Controllers{

    public function __construct() {
        # Solo accesible por usuarios no logeados
        parent::__construct(false, false,true);
        

    }

    // -------------------------------------------------

    /**
     * Método - Vista principal del login
     */

    public function signin(){
        echo $this->view->render('auth/login');
    }
}
