<?php
		if (isset($_POST['idpb']) and $_POST['idpb'] > 0 and is_numeric($_POST['idpb']) and isset($_SESSION['username'])) {
			$idpb = $_POST['idpb'];
			$mg_is_p = mysql_query("SELECT cuentas_idcuenta, publicaciones_idpublicacion FROM publicaciones_megusta WHERE publicaciones_idpublicacion = '$idpb' AND cuentas_idcuenta = '$pf[idcuenta]' ") or die(mysql_error());
			$mg_is =  mysql_num_rows($mg_is_p);
			if ($mg_is > 0) {
				echo "Ya votaste";
				} else {
					$mg_p = mysql_query("SELECT * FROM publicaciones_megusta WHERE publicaciones_idpublicacion = '$idpb'") or die(mysql_error());
					$mg = mysql_num_rows($mg_p);
					$ia = mysql_query("INSERT INTO `publicaciones_megusta` (`cuentas_idcuenta`,`publicaciones_idpublicacion`) VALUES ('".$pf['idcuenta']."','".$idpb."')") or die(mysql_error());
					echo $mg + 1;
					}
			} else {
				echo "Inicia Sesión";
				}
