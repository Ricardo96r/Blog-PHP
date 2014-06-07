<?php
if (isset($_POST['msg']) and isset($_POST['idmsg']) and is_numeric($_POST['idmsg']) and $_POST['idmsg'] > 0 and isset($_SESSION['username'])) {
		$comentario = antiSqlInjection($_POST['msg']);
		$idmsg = antiSqlInjection($_POST['idmsg']);
		
		if(!isset($comentario) and empty($comentario)) {
			echo 'Porfavor no deje campos vacios';
		} elseif(strlen($comentario) < 20) {
			echo 'La nota es muy corta, tiene que tener mas de 20 caracteres';
		} elseif(strlen($comentario) > 400){
			echo 'La nota es muy larga, el máximo de caracteres es 400';
		} else {
		$enviar_nota = $db->query("
			INSERT INTO `comentarios` (`cuentas_idcuenta`, `publicaciones_idpublicacion`, `comentario`) 
			VALUES (".$pf['idcuenta'].','.$idmsg.",'".$comentario."')");
		echo 'Comentario enviado';
		}
	
	} else {
		echo 'Error';
		}