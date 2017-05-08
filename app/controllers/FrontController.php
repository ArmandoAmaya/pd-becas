<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------

class FrontController extends Controllers{

    public function __construct() {
        parent::__construct();
    }

    // -------------------------------------------------

    /**
     * Método principal index 
     */
    public function index(){
        echo $this->view->render('front/index');
    }
    // -------------------------------------------------
    
}
