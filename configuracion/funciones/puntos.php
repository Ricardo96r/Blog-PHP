<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
/*
 * Funcion que suma puntos a cualquier tabla que tenga la columna puntos en mysql
 * $tabla = la tabla de mysql que es nombrada
 * $signo = al signo de sumar o restar
 * $puntos = los puntos que seran sumados o restados a la columna 'puntos'
 */ 

function puntos($signo, $puntos, $tabla, $idnombre, $id) {
	global $db;
	$puntaje = $db->query('UPDATE '.$tabla." SET  puntos = puntos".$signo.$puntos." WHERE ".$idnombre." = ".$id);
}