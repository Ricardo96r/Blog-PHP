<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST['idpb']) && $_POST['idpb'] > 0 && is_numeric($_POST['idpb']) && isset($_SESSION['username'])) {
	$idpb = $_POST['idpb'];
	if ($mg_is_p = $db->query('SELECT cuentas_idcuenta, comentarios_idpublicacion FROM comentarios_megusta WHERE comentarios_idpublicacion = '.$idpb.' AND cuentas_idcuenta = '.$pf['idcuenta'])) {
		$mg_is =  $mg_is_p->num_rows;
	}
	if ($mg_p = $db->query('SELECT * FROM comentarios_megusta WHERE comentarios_idpublicacion = '.$idpb)) {
		$mg = $mg_p->num_rows;
	}
	if ($mg_is > 0) {
		$ia = $db->query("DELETE FROM comentarios_megusta WHERE cuentas_idcuenta = ".$pf['idcuenta']." and comentarios_idpublicacion = ".$idpb);
		echo $mg - 1;
		} else {
			$ia = $db->query('INSERT INTO `comentarios_megusta` (`cuentas_idcuenta`,`comentarios_idpublicacion`) VALUES ('.$pf['idcuenta'].','.$idpb.')');
			echo $mg + 1;
			}
	} else {
		echo 'Inicia sesión';
		}
