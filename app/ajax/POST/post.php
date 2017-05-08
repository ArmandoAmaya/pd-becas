<?php  

// ------------------------------

defined('INDEX') or die('No estas en index.');


// ------------------------------

/**
 * Login - Sirve para logear el usuario
 * @return un objeto json
 */

$router->post('/login',function($request, $response) {
	$model = new Login;
	$resp = $response->withJson($model->SignIn($_POST));
	return $resp;
});


/**
 * Reg - Sirve para registrar un usuario
 * @return un objeto json
 */

$router->post('/reg',function($request, $response) {
	$model = new Register;
	$resp = $response->withJson($model->Reg($_POST));
	return $resp;
});

/**
 * Perfil - Sirve para editar un perfil de usurio
 * @return un objeto json
 */

$router->post('/perfil/edit',function($request, $response) {
	$model = new Perfil;
	$resp = $response->withJson($model->Edit($_POST));
	return $resp;
});


/**
 * Perfil - Sirve para enviar la solicitud
 * @return un objeto json
 */

$router->post('/perfil/solicitud',function($request, $response) {
	$model = new Perfil;
	$resp = $response->withJson($model->Solicitud($_POST));
	return $resp;
});