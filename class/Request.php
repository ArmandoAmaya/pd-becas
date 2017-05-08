<?php
// ------------------------------------------------
final class Request{

    // ------------------------------------------------
    private $url = null;
    private $controller = null;
    private $method = null;
    private $arg = array();
    private $obj = null;
    // ------------------------------------------------

    /**
     * Constructor: realiza el parseo de urls
     */

    final public function __construct(){
        if (isset($_GET['url'])) {
            $this->url = parse_url($_GET['url'], PHP_URL_PATH);
            $this->url = explode('/', $this->url);
            $this->url = array_filter($this->url);

            $this->controller = !Val::alphanum($this->url[0]) || $this->url[0] == 'index.php' ? 'FrontController' :  Str::firstM( array_shift($this->url) ) . 'Controller';
            if (!$this->method = array_shift($this->url)) {
                $this->method = 'index';
            }

            $this->arg = sizeof($this->url) > 0 && !empty($this->url) ? $this->url : array();

        }else{
            $this->controller = 'FrontController';
            $this->method = 'index';
        }
        
    }

    // ------------------------------------------------
    //
    /**
     * Devuelve el controlador actual
     * @return controlador actual
     */

    final public function _getc() : string {
        return trim($this->controller);
    }

    // ------------------------------------------------
    /**
     * Devuelve el método actual
     * @return método actual
     */
    final public function _getm() : string {
        return $this->method;
    }

    // ------------------------------------------------
    /**
     * Devuelve el o los argumentos actuales
     * @return argumento actual
     */
    final public function _getargs() : array {
        return $this->arg;
    }

    // ------------------------------------------------

    final public function _indep(string $class) {
        if (is_readable('./app/models/'.$class.'.php') && !$this->obj instanceof $class) {
            $this->obj = new $class;
        }
        return $this->obj;
    }

    // ------------------------------------------------
    
}
?>
