<?php  

// ------------------------------

defined('INDEX') or die('No estas en index.');


// ------------------------------

/**
 * Municipio - Sirve para logear el usuario
 * @return un objeto json
 */

$router->get('/municipio',function($request, $response) {
	$id = (int) $_GET['id'];
	$selected = (int) isset($_GET['selected']) ?? '';
	
	$municipios = (new Solicitantes)->get_location('municipio', "WHERE id_estado ='$id'");
	$m = '';
	foreach ($municipios as $id => $municipio) {
		$m .= '<option '.(intval($selected) && $id == $selected ? 'selected' : '').' value="'.$id.'">'.$municipio.'</option>';
	}
	return $m;
});

// ------------------------------

/**
 * Municipio - Sirve para logear el usuario
 * @return un objeto json
 */

$router->get('/parroquia',function($request, $response) {
	$id = (int) $_GET['id'];
	$selected = (int) isset($_GET['selected']) ?? '';

	$parroquias = (new Solicitantes)->get_location('parroquia', "WHERE id_municipio ='$id'");
	$p = '';
	foreach ($parroquias as $id => $parroquia) {
		$p .= '<option '.(intval($selected) && $id == $selected ? 'selected' : '').' value="'.$id.'">'.$parroquia.'</option>';
	}
	return $p;
});


