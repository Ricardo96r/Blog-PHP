<?php
	# Comienzo de session
	session_start();
	
	# Compresion GZip
	if(!extension_loaded('zlib')){
		ini_set('zlib.output_compression_level', 1);  
		ob_start('ob_gzhandler'); 
	}
	
	# Configuración global
	require_once("configuracion/database.php");
	require_once("configuracion/propiedades.php");
	require_once("configuracion/funciones.php");
	
	switch($gtp){
		case NULL:
			header("Location: ?".$prop['nombre']."=principal");
			break;
		case "principal":
			include($prop['tema']."/header.php");
			include($prop['tema']."/nav.php");
			include("fuente/publico/principal.php");
			include($prop['tema']."/aside.php");
			break;
		case "usuario":
			include($prop['tema']."/header.php");
			include("fuente/usuario/usuario.php");
			break;
		case "admin":
			include($prop['tema']."/header.php");
			include($prop['tema']."/nav.php");
			include("fuente/admin/principal.php");
			include($prop['tema']."/aside.php");
			break;
		case "perfil":
			include($prop['tema']."/header.php");
			include($prop['tema']."/nav-perfil.php");
			include("fuente/usuario/usuario.php");
			include($prop['tema']."/aside.php");
			break;
		default:
			include($prop['tema']."/header.php");
			include($prop['tema']."/nav.php");
			include("fuente/publico/principal.php");
			include($prop['tema']."/aside.php");
			break;
	}

	mysql_close($conn);
	ob_end_flush();

?>