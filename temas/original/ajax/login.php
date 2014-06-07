<?php
if (isset($_POST['permiso']) and $_POST['permiso'] == 'allowed') {
	if (isset($_POST['email2']) and !empty($_POST['email2']) and isset($_POST['contraseña2']) and !empty($_POST['contraseña2'])) {
		if ($sesion = $db->query("SELECT email, contraseña FROM cuentas WHERE email = '".$_POST['email2']."'")) {
			$sesion1 = $sesion->fetch_assoc();
		}
		if ($_POST['contraseña2'] == $sesion1['contraseña']) {
			$_SESSION['username'] = $_POST['email2'];
			echo 'Conectando...';
		} else {
			echo 'Contraseña incorrecta o email incorrecto';
			}
	} else {
		echo 'Alguno de los campos esta vacio';
		}	
} else {
	echo 'No tienes permiso para entrar aqui!';
	}