<?php
// ------------------------------------------
defined('INDEX') or die('No estas en index');
// ------------------------------------------

abstract class Controllers{

    // ------------------------------------------
    protected $request;
    protected $view;
    protected $id;
    // ------------------------------------------

    /**
     * Constructor: Inicia la configuracion por defecto para todos los controladores
     */
    protected function __construct(bool $authLog = false, bool $adminOnly = false, bool $authUnlog = false) {

        # Llamado del request
        global $request;
        $this->request = $request;
        # Para usuarios logeados
        if (!isset($_SESSION[SESSION_ID]) && $authLog) {
            Str::redir('auth/signin/');
        }
        # Para usuarios no logeados
        if (isset($_SESSION[SESSION_ID]) && $authUnlog) {
            Str::redir();
        }
        if (isset($_SESSION['rango']) and 0 == $_SESSION['rango']) {
            Str::redir('../');
        }

        if (isset($_SESSION['rango']) and $_SESSION['rango'] != 2 and $adminOnly) {
            Str::redir();
        }

        $this->id = (sizeof($request->_getargs()) === 1 and is_numeric($request->_getargs()[0]));

        # Uso de los motores de plantilla
        if (TWIG) {
            $this->view = new Twig_Environment(new Twig_Loader_Filesystem('./views/twig/'),array(
				//'cache' => './views/cache/',
				//'auto_reload' => true,
				'debug' => true
			));

            $this->view->addGlobal('SESSION', $_SESSION);
			$this->view->addGlobal('GET', $_GET);
			$this->view->addGlobal('GET', $_POST);
			$this->view->addGlobal('request', $this->request);
            $this->view->addGlobal('c', str_replace('Controller', '', $this->request->_getc()));
            $this->view->addGlobal('m', $this->request->_getm());
            if (isset($_SESSION[SESSION_ID])) {
                $users = new Users;
                $this->view->addGlobal('user', $users->get_user($_SESSION[SESSION_ID]));
            }
            

            $this->view->addExtension(new Gen);
            $this->view->addExtension(new Boots);
            $this->view->addExtension(new Fl);
            $this->view->addExtension(new Val);
            $this->view->addExtension(new Twig_Extension_Debug());

        }else{
            $this->view = new League\Plates\Engine('./views/plates/', 'phtml');
            $this->view->addData(['request' => $this->request]);
        }

    }

    // ------------------------------------------

}
?>
