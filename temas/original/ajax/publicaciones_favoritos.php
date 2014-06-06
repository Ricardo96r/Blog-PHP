<?php
		if (isset($_POST['idpb']) and $_POST['idpb'] > 0 and is_numeric($_POST['idpb']) and isset($_SESSION['username'])) {
			$idpb = $_POST['idpb'];
			$fav_is_p = mysql_query("SELECT cuentas_idcuenta, publicaciones_idpublicacion FROM publicaciones_favoritos WHERE publicaciones_idpublicacion = '$idpb' AND cuentas_idcuenta = '$pf[idcuenta]' ") or die(mysql_error());
			$fav_is =  mysql_num_rows($fav_is_p);
			if ($fav_is > 0) {
				echo "Ya votaste";
				} else {
					$fav_p = mysql_query("SELECT * FROM publicaciones_favoritos WHERE publicaciones_idpublicacion = '$idpb'") or die(mysql_error());
					$fav = mysql_num_rows($fav_p);
					$ia = mysql_query("INSERT INTO `publicaciones_favoritos` (`cuentas_idcuenta`,`publicaciones_idpublicacion`) VALUES ('".$pf['idcuenta']."','".$idpb."')") or die(mysql_error());
					echo $fav + 1;
					}
			} else {
				echo "Inicia Sesión";
				}