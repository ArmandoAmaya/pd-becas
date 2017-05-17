<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------
class ContactoController extends Controllers{
 
    public function __construct() {
        parent::__construct();
     
    }

    // -------------------------------------------------

    /**
     * Método - Vista principal de contacto
     */

    public function index(){
        echo $this->view->render('contacto/index');
    }
}
