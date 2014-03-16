<?php
	# Propiedades MYSQL
	$prop_op = mysql_query("SELECT * FROM propiedades WHERE idpropiedad = 1", $conn) or die (mysql_error());
	$prop = mysql_fetch_array($prop_op);
		
	# Define $gtp variable
	$gtp = isset($_GET["$prop[nombre]"]) ? $_GET["$prop[nombre]"] : "";
	
	# Valores de PERFIL especificado por $_SESSION['username']
	if (isset($_SESSION['username'])) {
		$pf_op = mysql_query("SELECT idcuenta, cuenta, email, nombres, apellidos, nacimiento, sexo, imagen_perfil FROM cuentas WHERE email = '$_SESSION[username]'", $conn) or die (mysql_error());
		$pf = mysql_fetch_array($pf_op);
	} else {
		// no pasa nada REVISAR
		}
?>