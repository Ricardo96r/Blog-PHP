<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}

if (isset($_GET['action'])) {
	$action = $_GET['action'];
	} else {
		header('Location: ?p=404');
		}

# Registro
if ($action == 'registro') {
	include('registro.php');
	
# Login
} elseif($action == 'login'){
	include('login.php');
	
# Publicaciones
} elseif($action == 'publicacion'){
	include('publicacion.php');
} elseif($action == 'publicaciones_megusta'){
	include('publicaciones_megusta.php');
} elseif($action == 'publicaciones_favoritos'){
	include('publicaciones_favoritos.php');
	
# Comentarios
} elseif($action == 'comentario'){
	include('comentario.php');
} elseif($action == 'comentarios_megusta'){
	include('comentarios_megusta.php');
} elseif($action == 'comentarios_favoritos'){
	include('comentarios_favoritos.php');
	
# SubComentarios
} elseif($action == 'subcomentario'){
	include('subcomentario.php');
	
# Configuracion
} elseif($action == 'configuracion_perfil_imagen'){
	include('configuracion_perfil_imagen.php');
} elseif($action == 'configuracion_perfil_imagen_fondo'){
	include('configuracion_perfil_imagen_fondo.php');
} elseif($action == 'configuracion_perfil_nombre'){
	include('configuracion_perfil_nombre.php');
	
# Seguridad
} elseif($action == 'seguridad_password'){
	include('seguridad_password.php');
	
} else {
	echo 'Error: 404';
	}