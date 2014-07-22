<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
function redireccionar($accion) {
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	if ($action === '404') {
		$extra = '?p=404';
		header("Location: http://$host$uri/$extra");
		exit;
	} else {
		echo "ERROR";
		}
}