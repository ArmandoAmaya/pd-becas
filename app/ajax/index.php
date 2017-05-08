<?php  
// ---------------------------------------

define('INDEX', true);

// ---------------------------------------

# Nucleo del sistema
require('../ajax.php');

// ---------------------------------------

$router = new \Slim\App;

if ($_POST) {
	include('POST/post.php');
}
if ($_GET) {
	include('GET/get.php');
}

$router->run();


?>