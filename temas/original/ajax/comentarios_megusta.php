<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST['idcom']) && $_POST['idcom'] > 0 && is_numeric($_POST['idcom']) && isset($_SESSION['username'])) {
	$idcom = $_POST['idcom'];
	if ($mg_is_p = $db->query('SELECT cuentas_idcuenta, comentarios_idcomentario FROM comentarios_megusta WHERE comentarios_idcomentario = '.$idcom.' AND cuentas_idcuenta = '.$pf['idcuenta'])) {
		$mg_is =  $mg_is_p->num_rows;
	}
	if ($mg_p = $db->query('SELECT * FROM comentarios_megusta WHERE comentarios_idcomentario = '.$idcom)) {
		$mg = $mg_p->num_rows;
	}
	if ($mg_is > 0) {
		$ia = $db->query("DELETE FROM comentarios_megusta WHERE cuentas_idcuenta = ".$pf['idcuenta']." and comentarios_idcomentario = ".$idcom);
		echo $mg - 1;
		} else {
			$ia = $db->query('INSERT INTO `comentarios_megusta` (`cuentas_idcuenta`,`comentarios_idcomentario`) VALUES ('.$pf['idcuenta'].','.$idcom.')');
			echo $mg + 1;
			}
	} else {
		echo 'Inicia sesión';
		}
