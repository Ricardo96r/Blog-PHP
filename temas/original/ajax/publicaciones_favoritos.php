<?php
		if (isset($_POST['idpb']) and $_POST['idpb'] > 0 and is_numeric($_POST['idpb']) and isset($_SESSION['username'])) {
			$idpb = $_POST['idpb'];
			
			if ($fav_is_p = $db->query("SELECT cuentas_idcuenta, publicaciones_idpublicacion FROM publicaciones_favoritos WHERE publicaciones_idpublicacion = '$idpb' AND cuentas_idcuenta = '$pf[idcuenta]' ")) {
				$fav_is =  $fav_is_p->num_rows;
			}
			if ($fav_is > 0) {
				echo "Ya votaste";
				} else {
					if ($fav_p = $db->query("SELECT * FROM publicaciones_favoritos WHERE publicaciones_idpublicacion = '$idpb'")) {
						$fav = $fav_p->num_rows;
					}
					$ia = $db->query("INSERT INTO `publicaciones_favoritos` (`cuentas_idcuenta`,`publicaciones_idpublicacion`) VALUES ('".$pf['idcuenta']."','".$idpb."')");
					echo $fav + 1;
					}
			} else {
				echo "Inicia Sesión";
				}