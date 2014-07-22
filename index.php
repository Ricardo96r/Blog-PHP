<?php
	# Comienzo de session
	session_start();
	
	#  Activa el almacenamiento en búfer de salida. Uso para la funcion header()
	ob_start();
	
	/* Todo tiene que pasar por index.php. 
	Si no pasa por este medio es redirigido a un 404 */
	$indexphp = TRUE;

	# Cargar configuracion
	require_once('configuracion/database.php');
	require_once('configuracion/propiedades.php');
	require_once('configuracion/load-func.php');
	
	if ($page != 'ajax') {
	# Cargar web
		require_once('temas/'.$prop['tema'].'/index.php');
	} else {
	# Cargar ajax
		require_once('temas/'.$prop['tema'].'/ajax/index.php');
	}
	
	# Volcar (enviar) el búfer de salida y deshabilitar el almacenamiento en el mismo. Uso para la funcion header()
	ob_end_flush();
	
	# Cierre de conexion mysql
	$db->close();