<?php		
	if ( isset($_SESSION['username'])) {
		$ruta = 'static-content/perfiles/';
		
		
		if (isset($_FILES['file_0'])) {
			$imagen = $_FILES['file_0'];
			list($ancho, $alto, $tipo, $atributos) = getimagesize($imagen['tmp_name']);
			$ext_o = explode(".", $imagen['name']);
			$extension = end($ext_o);
			$name = ($pf['idcuenta']).'-'.rand().".".$extension;
		} else {
			$imagen = NULL;
			}

	    
	/*
	-----------------------
	Errores al registrarse
	-----------------------
	*/
	
	//$cuenta
	if(!isset($imagen)) {
		echo 'No existe la imagen';
	} else if($ancho != $alto) {
		echo "Solo se aceptan <strong>imagenes cuadradas!</strong>. Tu imagen tiene un tamaño de: <strong>".$ancho."x".$alto."</strong>";
	} else if($imagen['size'] > 3000000) {
		echo 'Foto invalida, la imagen exede los 3MB!';
	} elseif($imagen['error'] > 0) {
		echo 'Error al subir la imagen!';
	/*} elseif (($_FILES['archivo']['type'] != 'image/*') and ($_FILES['archivo']['type'] = 'image/gif')) {
		echo 'Solo puede subir imagenes exeptuando los gifs!';*/
	} elseif(file_exists($ruta.$name)) {
		echo 'Error anormal, reporte. Intente nuevamente.';
	
	/*
	----------------
	Envio de datos
	----------------
	*/
	
	} else {
		$select_img_pf_o = $db->query("SELECT imagen_perfil FROM cuentas WHERE idcuenta = ".$pf['idcuenta']);
		$select_img_pf = $select_img_pf_o->fetch_array();
		unlink($ruta.$select_img_pf['imagen_perfil']);
		
		$cambiar_img_pf = $db->query("UPDATE cuentas SET imagen_perfil = '".$name."' WHERE idcuenta = ".$pf['idcuenta']);
		move_uploaded_file($imagen['tmp_name'], $ruta.$name);
		echo "Finalizado";

		}
	} else {
		echo 'No tienes permiso para entrar aqui!';
		}