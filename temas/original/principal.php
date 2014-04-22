<?php
	if($page == ""){
		if (isset($_SESSION['username'])) {
			include 'principal-contenido.php';
		} else {
			include 'intro.php';
			}
	} elseif($page == "registro"){
		include('registro.php');
	} elseif($page == "login"){
		include('login_error.php');
	} elseif($page == "cerrar_sesión"){
		include('cerrar_sesion.php');
	} elseif($page == "opciones"){
		include('opciones.php');
	} elseif($page == "perfil"){
		include('perfil.php');
	} elseif($page == "publicar"){
		include('publicar.php');
	} elseif($page == "404"){
		include('404.php');
	}else{
		header("Location: ?p=404");
	}
?>