<?php		
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_SESSION['username'])) {
		if (isset($_POST['nombres'])) {
			$nombres = depurar($_POST['nombres']);
		} else {
			$nombres = NULL;
			}	    
	/*
	-----------------------
	Errores al registrarse
	-----------------------
	*/
	
	//$cuenta
	if(!isset($nombres) or empty($nombres)) {
		echo 'Rellene el formulario';
	} elseif(strlen($nombres) < 1){
		echo 'Porfavor llene el campo nombres';
	} elseif(mb_strlen($nombres, 'utf8') > 21){
		echo 'El campo nombre(s) tiene que ser menor o igual a 20 caracteres ';
	
	/*
	----------------
	Envio de datos
	----------------
	*/
	
	} else {
		$cambiar_nombre = $db->query("UPDATE cuentas SET nombre = '".$nombres."' WHERE idcuenta = ".$pf['idcuenta']);
		echo "Finalizado";
		}
	} else {
		header('Location: ?p=404');
		}