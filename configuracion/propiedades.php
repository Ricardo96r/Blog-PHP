<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}

# Inicializada variable global $prop
if ($prop_op = $db->query('SELECT * FROM propiedades WHERE idpropiedad = 1')) {
	$prop = $prop_op->fetch_assoc();		
	$prop_op->close();
	}
	
# Inicializada variable global $pf cuando se incia sesion
if (isset($_SESSION['username'])) {
	if($pf_op = $db->query("SELECT idcuenta, cuenta, email, nombre, nacimiento, sexo, imagen_perfil, imagen_perfil_fondo
								FROM cuentas WHERE email = '".$_SESSION['username']."'")) {
	$pf = $pf_op->fetch_assoc();
	}
}

if(isset($_GET['p'])) {
	$page = $_GET['p'];
	} else {
		$page = '';
		}