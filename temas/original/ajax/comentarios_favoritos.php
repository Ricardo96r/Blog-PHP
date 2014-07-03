<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST['idpb']) && $_POST['idpb'] > 0 && is_numeric($_POST['idpb']) && isset($_SESSION['username'])) {
	$idpb = $_POST['idpb'];
	if ($fav_is_p = $db->query('SELECT cuentas_idcuenta, comentarios_idpublicacion FROM comentarios_favoritos WHERE comentarios_idpublicacion = '.$idpb.' AND cuentas_idcuenta = '.$pf['idcuenta'])) {
		$fav_is =  $fav_is_p->num_rows;
	}
	if ($fav_p = $db->query('SELECT * FROM comentarios_favoritos WHERE comentarios_idpublicacion = '.$idpb)) {
		$fav = $fav_p->num_rows;
	}
	if ($fav_is > 0) {
		$ia = $db->query("DELETE FROM comentarios_favoritos WHERE cuentas_idcuenta = ".$pf['idcuenta']." and comentarios_idpublicacion = ".$idpb);
		echo $fav - 1;
		} else {
			$ia = $db->query('INSERT INTO `comentarios_favoritos` (`cuentas_idcuenta`,`comentarios_idpublicacion`) VALUES ('.$pf['idcuenta'].','.$idpb.')');
			echo $fav + 1;
			}
	} else {
		echo 'Inicia sesión';
		}
