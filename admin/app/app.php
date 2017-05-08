<?php
// ------------------------------
# Todo se carga desde index
defined('INDEX') or die('No estas en index.');

// ------------------------------

# No estamos en ajax
define('AJAX', false);

// ------------------------------

# Control de versión
try {
	if (version_compare(phpversion(), '7.0.0', '<')) {
		throw new Exception('<b>Error: </b> La version de php debe ser como mínimo PHP7.0.0 <br> <b>Tu versión es: </b>'.phpversion());

	}
} catch (Exception $e) {
	die($e->getMessage());
}


// ------------------------------

# Carga de la configuración
require('app/config.php');

// ------------------------------

#Autoloads
require('vendor/autoload.php');
require('class/Autoload.php');
new Autoload();


// ------------------------------

# Tema de kint
Kint::$theme = 'solarized-dark';



// ------------------------------

# Url's amigables
$request = new Request;

// ------------------------------

# Protección
!PROTECTION ?: new Protection;
?>
