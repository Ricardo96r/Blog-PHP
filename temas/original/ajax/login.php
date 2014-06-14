<?php
if (isset($_POST['permiso']) and $_POST['permiso'] == 'allowed') {
	if (isset($_POST['email']) and !empty($_POST['email']) and isset($_POST['contraseña']) and !empty($_POST['contraseña'])) {
		if ($sesion = $db->query("SELECT email, contraseña FROM cuentas WHERE email = '".$_POST['email']."'")) {
			$sesion1 = $sesion->fetch_assoc();
		}
		if ($_POST['contraseña'] == $sesion1['contraseña']) {
			$_SESSION['username'] = $_POST['email'];
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