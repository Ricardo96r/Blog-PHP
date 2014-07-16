<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST['msg']) && isset($_POST['idmsg']) && is_numeric($_POST['idmsg']) && $_POST['idmsg'] > 0 && isset($_SESSION['username'])) {
		$subcomentario = depurar($_POST['msg']);
		$idmsg = depurar($_POST['idmsg']);
		
		if(!isset($subcomentario) and empty($subcomentario)) {
			echo 'Porfavor no deje campos vacios';
		} elseif(strlen($subcomentario) < 20) {
			echo 'La nota es muy corta, tiene que tener mas de 20 caracteres';
		} elseif(strlen($subcomentario) > 400){
			echo 'La nota es muy larga, el máximo de caracteres es 400';
		} else {
		$enviar_nota = $db->query('
			INSERT INTO `subcomentarios` (`cuentas_idcuenta`, `comentarios_idcomentario`, `subcomentario`) 
			VALUES ('.$pf['idcuenta'].','.$idmsg.",'".$subcomentario."')");
		echo 'subcomentario enviado';
		}
		
	} else {
		echo 'Error';
		}