<?php
	# Comienzo de session
	session_start();
	
	# Compresion GZip
	if(!extension_loaded('zlib')){
		ini_set('zlib.output_compression_level', 1);  
		ob_start('ob_gzhandler'); 
	}
	
	if (isset($_SESSION['admin'])) {
		# Cargar configuracion
		require_once("configuracion/database.php");
		require_once("configuracion/propiedades.php");
		require_once("configuracion/funciones.php");
		
		if ($page != 'ajax') {
		# Cargar web
			require_once("temas/$prop[tema]/index.php");
		} else {
		# Cargar ajax
			require_once("temas/$prop[tema]/ajax/index.php");
		}
	
		mysql_close($conn);
		ob_end_flush();
	} else {
		echo "<div style='text-align:center; font-size:50px;'> TEST WEB</div>";
		//header('location: http://www.hostinger.es/');
		}

?>