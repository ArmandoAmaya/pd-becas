<?php  

// ------------------------------

defined('INDEX') or die('No estas en index.');

// ------------------------------

define('AJAX', true);

// ------------------------------

# Carga de la configuración
require('../config.php');

// ------------------------------

#Autoloads
require('../../vendor/autoload.php');
require('../../class/Autoload.php');
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