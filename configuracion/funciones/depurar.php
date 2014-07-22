<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
function depurar( $variable ) {
	global $db;
	if (isset($variable)) {
		$result = strip_tags($variable);               // funcion que elimina etiquetas html y php
		$result = stripslashes($variable);           // funcion que elimina las barras invertidas 
		$result = htmlentities($variable);       //elimina etiquetas html y javascrip
		$result = $db->real_escape_string($variable); //elimina todo lo que tenga que ver con mysql
	} else {
		$result = '';
		}
	return $result;							
}