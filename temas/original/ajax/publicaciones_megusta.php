<?php
		if (isset($_POST['idpb']) and $_POST['idpb'] > 0 and is_numeric($_POST['idpb']) and isset($_SESSION['username'])) {
			$idpb = $_POST['idpb'];
			if ($mg_is_p = $db->query("SELECT cuentas_idcuenta, publicaciones_idpublicacion FROM publicaciones_megusta WHERE publicaciones_idpublicacion = '$idpb' AND cuentas_idcuenta = '$pf[idcuenta]' ")) {
				$mg_is =  $mg_is_p->num_rows;
			}
			if ($mg_is > 0) {
				echo "Ya votaste";
				} else {
					if ($mg_p = $db->query("SELECT * FROM publicaciones_megusta WHERE publicaciones_idpublicacion = '$idpb'")) {
						$mg = $mg_p->num_rows;
					}
					$ia = $db->query("INSERT INTO `publicaciones_megusta` (`cuentas_idcuenta`,`publicaciones_idpublicacion`) VALUES ('".$pf['idcuenta']."','".$idpb."')");
					echo $mg + 1;
					}
			} else {
				echo "Inicia Sesión";
				}
