<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}

/*
	Load: HEADER
*/
include('temas/'.$prop['tema'].'/header.php');

/*
	Load: NAV
*/
include('temas/'.$prop['tema'].'/nav.php');

/*
	Load: SECTION
*/
if($page == ''){
	include 'principal-contenido.php';
} elseif($page == 'registro'){
	include('registro.php');
} elseif($page == 'login'){
	include('login_error.php');
} elseif($page == 'cerrar_sesión'){
	include('cerrar_sesion.php');
} elseif($page == 'configuracion'){
	include('configuracion.php');
} elseif($page == 'perfil'){
	include('perfil.php');
} elseif($page == 'explorar'){
	include('explorar.php');
} elseif($page == 'seguridad'){
	include('seguridad.php');
} elseif($page == 'buscar'){
	include('buscar.php');
} elseif($page == 'contactanos'){
	include('contactanos.php');
} elseif($page == 'recuperar_contraseña'){
	include('forgotPassword.php');
} elseif($page == '404'){
	include('404.php');
}else{
	header('Location: ?p=404');
}

/*
	Load: Aside
*/
include('temas/'.$prop['tema'].'/aside.php');
/*
	Load: Aside
*/
include('temas/'.$prop['tema'].'/footer.php');