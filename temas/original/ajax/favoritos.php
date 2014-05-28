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
			$fav_is_p = mysql_query("SELECT cuentas_idcuenta, publicaciones_idpublicacion FROM favoritos WHERE publicaciones_idpublicacion = '$idpb' AND cuentas_idcuenta = '$pf[idcuenta]' ") or die(mysql_error());
			$fav_is =  mysql_num_rows($fav_is_p);
			if ($fav_is > 0) {
				echo "Ya votaste";
				} else {
					$fav_p = mysql_query("SELECT * FROM favoritos WHERE publicaciones_idpublicacion = '$idpb'") or die(mysql_error());
					$fav = mysql_num_rows($fav_p);
					$ia = mysql_query("INSERT INTO `favoritos` (`cuentas_idcuenta`,`publicaciones_idpublicacion`) VALUES ('".$pf['idcuenta']."','".$idpb."')") or die(mysql_error());
					echo $fav + 1;
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
