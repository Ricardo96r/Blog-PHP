<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST['idcom']) && $_POST['idcom'] > 0 && is_numeric($_POST['idcom']) && isset($_SESSION['username'])) {
	$idcom = $_POST['idcom'];
	if ($mg_is_p = $db->query('SELECT cuentas_idcuenta, comentarios_idcomentario FROM comentarios_favoritos 
		WHERE comentarios_idcomentario = '.$idcom.' AND cuentas_idcuenta = '.$pf['idcuenta'])) {
		$mg_is =  $mg_is_p->num_rows;
	}
	if ($mg_is > 0) {
		echo 'Ya votaste';
		} else {
			if ($mg_p = $db->query('SELECT * FROM comentarios_favoritos WHERE comentarios_idcomentario = '.$idcom)) {
				$mg = $mg_p->num_rows;
			}
			$ia = $db->query('INSERT INTO `comentarios_favoritos` (`cuentas_idcuenta`,`comentarios_idcomentario`) VALUES ('.$pf['idcuenta'].','.$idcom.')');
			echo $mg + 1;
			}
	} else {
		echo 'Inicia Sesión';
		}