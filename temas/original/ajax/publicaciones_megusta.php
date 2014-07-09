<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST['idpb']) && $_POST['idpb'] > 0 && is_numeric($_POST['idpb']) && isset($_SESSION['username'])) {
	$idpb = $_POST['idpb'];
	
	if ($mg_is_p = $db->query('SELECT cuentas_idcuenta, publicaciones_idpublicacion FROM publicaciones_megusta WHERE publicaciones_idpublicacion = '.$idpb.' AND cuentas_idcuenta = '.$pf['idcuenta'])) {
		$mg_is =  $mg_is_p->num_rows;
	}
	
	if ($mg_p = $db->query('SELECT * FROM publicaciones_megusta WHERE publicaciones_idpublicacion = '.$idpb)) {
		$mg = $mg_p->num_rows;
	}
	
	if ($mg_is > 0) {
		$ia = $db->query("DELETE FROM publicaciones_megusta WHERE cuentas_idcuenta = ".$pf['idcuenta']." and publicaciones_idpublicacion = ".$idpb);
		puntos('-','1','publicaciones','idpublicacion',$idpb);
		echo $mg - 1;
	} else {
		$ia = $db->query('INSERT INTO `publicaciones_megusta` (`cuentas_idcuenta`,`publicaciones_idpublicacion`) VALUES ('.$pf['idcuenta'].','.$idpb.')');
		puntos('+','1','publicaciones','idpublicacion',$idpb);
		echo $mg + 1;
		}
		
} else {
	echo 'Inicia sesión';
	}
