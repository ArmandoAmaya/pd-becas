<?php
// ---------------------------------------
# Tipado estricto
declare(strict_types=1);

// ---------------------------------------
# Todo se carga desde index
defined('INDEX') or die('No estas en index.');

// ---------------------------------------

# Definición de la zona horaria - lista: http://php.net/manual/es/timezones.america.php
date_default_timezone_set('America/Caracas');

// ---------------------------------------

# Constantes del sistema
define('URL', 'http://localhost:8080/pdvsa/admin/');
define('TITLE', 'Panel administrativo PDVSA');
define('MONEY', 'Bs');
define('SESSION_ID', 'session_id');
define('PROTECTION', true);
define('TWIG', true);


// ---------------------------------------

# Control de sesiones
session_start([
    'use_cookies' => true,
    'use_strict_mode' => true,
    'cookie_httponly' => true,
    'cookie_lifetime' => 18000
]);


// ---------------------------------------

# Datos de la base de Datos
/**
 * Parametros para conectar a la base de Datos - Datos a rellenar en database.ini
 * @param host = Hosting a conectar - por defecto: localhost
 * @param pass = Contraseña del gestor de base de datos - si no tiene, dejar campo vacío
 * @param user = Nombre de usuario del metor de base de datos - por defecto: root
 * @param port = Puerto para conectar a la base de datos- si no tiene, dejar campo vacío
 * @param protocol = Prototocolo de conexión - por defecto: TPC
 * @param driver = Motor de base de datos a la cual se quiere conectar - por defecto: mysql
 * Lista de motores de base de datos aceptados: mysql, postgress, odbc, oracle, sqlite, firebird, cubrid
 */

define('DATABASE', parse_ini_file((AJAX ? '../../': '') . 'database.ini', true)['database']);


// ---------------------------------------

# Datos de PHPMailer
define('PHPM_HOST', 'p3plcpnl0173.prod.phx3.secureserver.net');
define('PHPM_USER', 'dev@ocrend.com');
define('PHPM_PASS', 'Devocrend++');
define('PHPM_PORT', 465);

?>
