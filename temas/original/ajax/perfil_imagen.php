<?php		
	if (isset($_POST['permiso']) and $_POST['permiso'] == "allowed" and isset($_SESSION['username'])) {
		$ruta = "static-content/perfil/";
		$name_m = mysql_query("SELECT idcuenta FROM cuentas WHERE email = '$_SESSION[username]'");
		$name = (mysql_num_rows($name_m))."-".rand();
	/*
	-----------------------
	Errores al registrarse
	-----------------------
	*/
	
	//$cuenta
	 if($_FILES["pf_imagen"]["size"] > 6000000) {
		echo "Foto invalida, la imagen exede los 5MB!";
	} elseif($_FILES["pf_imagen"]["error"] > 0) {
		echo "Error al subir la imagen!";
	/*} elseif (($_FILES['archivo']['type'] != "image/*") and ($_FILES['archivo']['type'] = "image/gif")) {
		echo "Solo puede subir imagenes exeptuando los gifs!";*/
	} elseif(file_exists($ruta.$name)) {
		echo "Error anormal, reporte. Intente nuevamente.";
	
	/*
	----------------
	Envio de datos
	----------------
	*/
	
	} else {
		$cambiar_img_pf = mysql_query("UPDATE cuentas SET imagen_perfil = '$name' WHERE idcuenta = '$pf[idcuenta]'") or die (mysql_error());
		
		move_uploaded_file($_FILES["pf_imagen"]["tmp_name"], $ruta.$name);
		}
	} else {
		echo "No tienes permiso para entrar aqui!";
		}