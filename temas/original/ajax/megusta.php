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
		require_once("../../../configuracion/database.php");
		require_once("../../../configuracion/propiedades.php");
		require_once("../../../configuracion/funciones.php");
		
		# Cargar
		if (isset($_POST['idpb']) and $_POST['idpb'] > 0 and is_numeric($_POST['idpb']) and isset($_SESSION['username'])) {
			$idpb = $_POST['idpb'];
			$mg_is_p = mysql_query("SELECT cuentas_idcuenta, publicaciones_idpublicacion FROM megusta WHERE publicaciones_idpublicacion = '$idpb' AND cuentas_idcuenta = '$pf[idcuenta]' ") or die(mysql_error());
			$mg_is =  mysql_num_rows($mg_is_p);
			if ($mg_is > 0) {
				echo "Ya votaste";
				} else {
					$mg_p = mysql_query("SELECT * FROM megusta WHERE publicaciones_idpublicacion = '$idpb'") or die(mysql_error());
					$mg = mysql_num_rows($mg_p);
					$ia = mysql_query("INSERT INTO `megusta` (`cuentas_idcuenta`,`publicaciones_idpublicacion`) VALUES ('".$pf['idcuenta']."','".$idpb."')") or die(mysql_error());
					echo $mg + 1;
					}
			} else {
				echo "Inicia Sesión";
				}
	
		mysql_close($conn);
		ob_end_flush();
	} else {
		echo "<div style='text-align:center; font-size:50px;'> TEST WEB</div>";
		//header('location: http://www.hostinger.es/');
		}
?>
