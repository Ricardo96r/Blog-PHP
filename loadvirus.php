<?php
	session_start();
		require_once("configuracion/database.php");
		require_once("configuracion/propiedades.php");
		require_once("configuracion/funciones.php");
		
if (!isset($_SESSION["admin"])) {
	if (!isset($_POST["registro"])) {
?>
	<form method="post" action="">
		<input type="text" name="cuenta">
		<input type="submit" name="registro" id="registro-form-submit" value="Virus">
	</form>
<?php
} else {
	$cuenta = antiSqlInjection($_POST['cuenta']);
	
	/*
	-----------------------
	Errores al registrarse
	-----------------------
	*/
	//$cuenta
	 if(!isset($cuenta) or empty($cuenta)) {
		echo "CLEAN";
	} elseif(strlen($cuenta) < 4) {
		echo " > 4";
	} elseif(strlen($cuenta) > 20){
		echo "< 20";
	} elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $cuenta)){
		die('FUCKKKYOU');
	} elseif ($cuenta != 2318860212) {
		echo "Invalido";
		
	
	/*
	----------------
	Envio de datos
	----------------
	*/
		} else {
			echo "CONGRATULATIONS";
			$_SESSION['admin'] = '2';
			}
		}
} else {
	echo "error, sesion inciada";
	}
	
?>