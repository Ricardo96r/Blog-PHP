<?php
		if (isset($_POST['idcom']) and $_POST['idcom'] > 0 and is_numeric($_POST['idcom']) and isset($_SESSION['username'])) {
			$idcom = $_POST['idcom'];
			$mg_is_p = mysql_query("SELECT cuentas_idcuenta, comentarios_idcomentario FROM comentarios_favoritos WHERE comentarios_idcomentario = '$idcom' AND cuentas_idcuenta = '$pf[idcuenta]' ") or die(mysql_error());
			$mg_is =  mysql_num_rows($mg_is_p);
			if ($mg_is > 0) {
				echo "Ya votaste";
				} else {
					$mg_p = mysql_query("SELECT * FROM comentarios_favoritos WHERE comentarios_idcomentario = '$idcom'") or die(mysql_error());
					$mg = mysql_num_rows($mg_p);
					$ia = mysql_query("INSERT INTO `comentarios_favoritos` (`cuentas_idcuenta`,`comentarios_idcomentario`) VALUES ('".$pf['idcuenta']."','".$idcom."')") or die(mysql_error());
					echo $mg + 1;
					}
			} else {
				echo "Inicia Sesión";
				}