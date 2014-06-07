<?php
if (isset($_POST['idcom']) and $_POST['idcom'] > 0 and is_numeric($_POST['idcom']) and isset($_SESSION['username'])) {
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