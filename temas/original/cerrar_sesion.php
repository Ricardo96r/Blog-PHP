<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
if(rango() >= 1) {
	session_destroy();
	echo 'cerrando sesión';
	header('Location: '.$_SERVER['HTTP_REFERER']);
} else {
	echo 'Tu no has iniciado sesión';
	header('Location: '.$_SERVER['HTTP_REFERER']);
	}