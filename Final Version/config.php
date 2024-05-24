<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'daniel');
define('DB_PASSWORD', 'madkam');
define('DB_NAME', 'madkam');

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($mysqli === false){
	die("Error: No se pudo conectar a la base de datos. " . $mysqli->connect_error);
}
?>
