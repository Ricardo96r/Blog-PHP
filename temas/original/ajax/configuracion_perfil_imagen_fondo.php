<?php		
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && rango() >= 1) {
		$ruta = 'static-content/perfiles_fondo/';

		if (isset($_FILES['fondo_0'])) {
			$imagen = $_FILES['fondo_0'];
			list($ancho, $alto, $tipo, $atributos) = getimagesize($imagen['tmp_name']);
			$ext_o = explode(".", $imagen['name']);
			$extension = end($ext_o);
			$name = ($pf['idcuenta']).'-'.rand().".".$extension;
			$finfo = image_type_to_mime_type(exif_imagetype($imagen['tmp_name']));
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
	} else if ($finfo != 'image/jpeg' && $finfo != 'image/png' ) {
		echo '<strong>Imagen no válida</strong>. Solo fotos con extenciones jpeg y png. Tu extencion es: '.$finfo;
	} else if($ancho <= $alto) {
		echo "Solo se aceptan <strong>imagenes rectangulares!</strong>. Tu imagen tiene un tamaño de: <strong>".$ancho."x".$alto."</strong>";
	} else if($imagen['size'] > 3145728) {
		echo 'Foto invalida, la imagen exede los 3MB!';
	} elseif($imagen['error'] > 0) {
		echo 'Error al subir la imagen!';
	
	/*
	----------------
	Envio de datos
	----------------
	*/
	
	} else {
		$select_img_pf_o = $db->query("SELECT imagen_perfil_fondo FROM cuentas WHERE idcuenta = ".$pf['idcuenta']);
		$select_img_pf = $select_img_pf_o->fetch_array();
		if (file_exists($ruta.$select_img_pf['imagen_perfil_fondo'])) {
			unlink($ruta.$select_img_pf['imagen_perfil_fondo']);
		}
		$cambiar_img_pf = $db->query("UPDATE cuentas SET imagen_perfil_fondo = '".$name."' WHERE idcuenta = ".$pf['idcuenta']);
		move_uploaded_file($imagen['tmp_name'], $ruta.$name);
		echo "Finalizado";
		}
	} else {
		header('Location: ?p=404');
		}