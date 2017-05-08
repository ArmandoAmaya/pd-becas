<?php
// -------------------------------------------------
defined('INDEX') or die('No estas en index');
// -------------------------------------------------
class LogoutController extends Controllers{

    public function __construct() {
        parent::__construct();
    }

    // -------------------------------------------------

    /**
     * Método para deslogear al usurio logeado
     */

    public function index(){
        unset($_SESSION[SESSION_ID]);
        session_write_close();
        session_unset();

        Str::redir();
    }
}
