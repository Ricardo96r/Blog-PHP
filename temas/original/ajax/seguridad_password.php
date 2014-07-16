<?php		
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_SESSION['username'])) {
		if (isset($_POST['contraseña1']) and isset($_POST['contraseña2'])) {
			$contraseña = depurar($_POST['contraseña']);
			$contraseña1 = depurar($_POST['contraseña1']);
			$contraseña2 = depurar($_POST['contraseña2']);
		if ($contraseña_verificar_p = $db->query("SELECT email, contraseña FROM cuentas WHERE email = '".$_SESSION['username']."'")) {
			$contraseña_verificar = $contraseña_verificar_p->fetch_array();
		}
		} else {
			$contraseña = NULL;
			$contraseña1 = NULL;
			$contraseña2 = NULL;
			}	    
	/*
	-----------------------
	Errores al registrarse
	-----------------------
	*/
	
	//$cuenta
	if(!isset($contraseña) or empty($contraseña)) {
		echo 'Complete los campos del formulario';
	} elseif($contraseña != $contraseña_verificar['contraseña']) {
		echo 'La contraseña actual no es válida';
	} elseif(!isset($contraseña1) or empty($contraseña1)) {
		echo 'Complete los campos del formulario';
	} elseif(!isset($contraseña2) or empty($contraseña2)) {
		echo 'Complete los campos del formulario';
	} elseif(mb_strlen($contraseña1, 'utf8') < 6){
		echo 'La contraseña debe ser mayor a 6 dígitos';
	} elseif(mb_strlen($contraseña1, 'utf8') > 21){
		echo 'La contraseña tiene que ser menor o igual a 20 caracteres';
	} elseif($contraseña1 != $contraseña2){
		echo 'Las contraseñas no son iguales';
	
	/*
	----------------
	Envio de datos
	----------------
	*/
	
	} else {
		$cambiar_contraseña = $db->query("UPDATE cuentas SET contraseña = '".$contraseña1."' WHERE idcuenta = ".$pf['idcuenta']);
		echo "Finalizado";
		}
	} else {
		header('Location: ?p=404');
		}