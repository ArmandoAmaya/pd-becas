<?php

// -------------------------------------------------
# Asegurar de cargar todo desde index
define('INDEX', true);

// -------------------------------------------------

# Nucleo principal
require('app/app.php');

// -------------------------------------------------

# Variables de la Url
$controller = $request->_getc();
$method = $request->_getm();
$args = $request->_getargs();

// -------------------------------------------------
# si no existe el controlador, entonces es ErrorController
if (!is_readable('app/controllers/'.$controller.'.php')) {
    $controller = 'ErrorController';
}

// -------------------------------------------------
# Incluimos el controlador actual
require('app/controllers/'.$controller.'.php');


// -------------------------------------------------
# Captura de errores y ejecucion del método
try {

    # Si la clase no existe
    if (!class_exists($controller)) {
        throw new Exception('<b>ERROR: </b>No existe una clase: <strong>"'.$controller.'"</strong>');
    }

    
    # Instanciamos el controlador
    $obj = new $controller($request->_indep(str_replace('Controller', '', $controller)));
    #Si el método no existe
    if (!method_exists($obj, $method)) {
        throw new Exception('<b>ERROR: </b>El método: <strong>"'.$method.'"</strong> no existe dentro de la clase:  <strong>"'.$controller.'"</strong>');
    }

    
    # Ejecutamos el método
    $obj->$method(...$args);
       

} catch (Exception $e) {

    # Si ocurre un error, lo capturamos
    echo $e->getMessage();
    exit(1);
}
