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
 * Admins - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/admins/add',function($request, $response) {
	$admins = new Admins;
	$json = $response->withJson($admins->Add($_POST));
	return $json;

});

/**
 * Admins - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/admins/edit',function($request, $response) {
	$admins = new Admins;
	$json = $response->withJson($admins->Edit($_POST));
	return $json;

});

/**
 * Admins - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/admins/delete',function($request, $response) {

	$admins = new Admins;
	$json = $response->withJson($admins->Delete($_POST['id']));
	return $json;

});

/**
 * Estados - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/estados/add',function($request, $response) {
	$estados = new Estados;
	$json = $response->withJson($estados->Add($_POST));
	return $json;

});

/**
 * Estados - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/estados/edit',function($request, $response) {
	$estados = new Estados;
	$json = $response->withJson($estados->Edit($_POST));
	return $json;

});

/**
 * Estados - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/estados/delete',function($request, $response) {
	$estados = new Estados;
	$json = $response->withJson($estados->Delete($_POST['id']));
	return $json;

});

/**
 * Municipios - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/municipios/add',function($request, $response) {
	$municipios = new Municipios;
	$json = $response->withJson($municipios->Add($_POST));
	return $json;

});

/**
 * Municipios - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/municipios/edit',function($request, $response) {
	$municipios = new Municipios;
	$json = $response->withJson($municipios->Edit($_POST));
	return $json;

});

/**
 * Municipios - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/municipios/delete',function($request, $response) {
	$municipios = new Municipios;
	$json = $response->withJson($municipios->Delete($_POST['id']));
	return $json;

});

/**
 * Parroquias - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/parroquias/add',function($request, $response) {
	$parroquias = new Parroquias;
	$json = $response->withJson($parroquias->Add($_POST));
	return $json;

});

/**
 * Parroquias - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/parroquias/edit',function($request, $response) {
	$parroquias = new Parroquias;
	$json = $response->withJson($parroquias->Edit($_POST));
	return $json;

});

/**
 * Parroquias - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/parroquias/delete',function($request, $response) {
	$parroquias = new Parroquias;
	$json = $response->withJson($parroquias->Delete($_POST['id']));
	return $json;

});



/**
 * Grupos - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/grupos/add',function($request, $response) {
	$grupos = new Grupos;
	$json = $response->withJson($grupos->Add($_POST));
	return $json;

});

/**
 * Grupos - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/grupos/edit',function($request, $response) {
	$grupos = new Grupos;
	$json = $response->withJson($grupos->Edit($_POST));
	return $json;

});

/**
 * Grupos - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/grupos/delete',function($request, $response) {
	$grupos = new Grupos;
	$json = $response->withJson($grupos->Delete($_POST['id']));
	return $json;

});

/**
 * Becas - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/becas/add',function($request, $response) {
	$becas = new Becas;
	$json = $response->withJson($becas->Add($_POST));
	return $json;

});

/**
 * Becas - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/becas/edit',function($request, $response) {
	$becas = new Becas;
	$json = $response->withJson($becas->Edit($_POST));
	return $json;

});

/**
 * Becas - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/becas/delete',function($request, $response) {
	$becas = new Becas;
	$json = $response->withJson($becas->Delete($_POST['id']));
	return $json;

});

/**
 * Solicitantes - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/solicitantes/add',function($request, $response) {
	$solicitantes = new Solicitantes;
	$json = $response->withJson($solicitantes->Add($_POST));
	return $json;

});

/**
 * Solicitantes - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/solicitantes/edit',function($request, $response) {
	$solicitantes = new Solicitantes;
	$json = $response->withJson($solicitantes->Edit($_POST));
	return $json;

});

/**
 * Solicitantes - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/solicitantes/delete',function($request, $response) {
	$solicitantes = new Solicitantes;
	$json = $response->withJson($solicitantes->Delete($_POST['id']));
	return $json;

});

/**
 * Empleados - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/empleados/add',function($request, $response) {
	$empleados = new Empleados;
	$json = $response->withJson($empleados->Add($_POST));
	return $json;

});

/**
 * Empleados - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/empleados/edit',function($request, $response) {
	$empleados = new Empleados;
	$json = $response->withJson($empleados->Edit($_POST));
	return $json;

});

/**
 * Empleados - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/empleados/delete',function($request, $response) {
	$empleados = new Empleados;
	$json = $response->withJson($empleados->Delete($_POST['id']));
	return $json;

});

/**
 * Solicitantes - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/solicitantes/solicitud',function($request, $response) {
	$solicitantes = new Solicitantes;
	$json = $response->withJson($solicitantes->Solicitud($_POST));
	return $json;
});



/**
 * Entrevistas - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/entrevistas/add',function($request, $response) {
	$entrevistas = new Entrevistas;
	$json = $response->withJson($entrevistas->Add($_POST));
	return $json;

});

/**
 * Entrevistas - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/entrevistas/edit',function($request, $response) {
	$entrevistas = new Entrevistas;
	$json = $response->withJson($entrevistas->Edit($_POST));
	return $json;

});

/**
 * Entrevistas - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/entrevistas/delete',function($request, $response) {
	$entrevistas = new Entrevistas;
	$json = $response->withJson($entrevistas->Delete($_POST['id']));
	return $json;

});


/**
 * Entrevista - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/entrevista/enviar',function($request, $response) {
	$s = new Solicitudes;
	$json = $response->withJson($s->Entrevista($_POST));
	return $json;

});

/**
 * Evaluar - ¿Para que sirve?
 * @return un objeto json
 */

$router->post('/evaluar',function($request, $response) {
	$s = new Solicitudes;
	$json = $response->withJson($s->Evaluar($_POST));
	return $json;

});
