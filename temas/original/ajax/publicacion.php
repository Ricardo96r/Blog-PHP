<?php		
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_SESSION['username'])) {
		$ruta = 'static-content/publicaciones/';

		if (isset($_FILES['publicacion_0']) && isset($_POST['publicacion'])) {
				$imagen = $_FILES['publicacion_0'];
				list($ancho, $alto, $tipo, $atributos) = getimagesize($imagen['tmp_name']);
				$ext_o = explode(".", $imagen['name']);
				$extension = end($ext_o);
				if ($name_m = $db->query('SELECT idimagenes FROM imagenes')) {
					$name = ($name_m->num_rows + 1).'-'.rand().".".$extension;;
				}
				$finfo = image_type_to_mime_type(exif_imagetype($imagen['tmp_name']));
				$publicacion = antiSqlInjection($_POST['publicacion']);
			} else {
				$error = TRUE;
			}	      
	/*
	-----------------------
	Errores al registrarse
	-----------------------
	*/
	
	//$cuenta
	if(isset($error)) {
		echo 'Coloque una imagen o escriba algo acerca de la publicación!'.$_FILES['publicacion_0']['tmp_name'].$_POST['publicacion'];
	} else if ($finfo != 'image/jpeg' && $finfo != 'image/png' ) {
		echo '<strong>Imagen no válida</strong>. Solo imagenes con extenciones jpeg y png. Tu extencion es: '.$finfo;
	} else if($imagen['size'] > 3145728) {
		echo 'Foto invalida, la imagen exede los 3MB!';
	} elseif($imagen['error'] > 0) {
		echo 'Error al subir la imagen!';
	} elseif(strlen($publicacion) < 20) {
		echo 'La nota es muy corta, tiene que tener mas de 20 caracteres';
	} elseif(strlen($publicacion) > 200) {
		echo 'La nota es muy larga, el máximo de caracteres es 200';
	
	
	/*
	----------------
	Envio de datos
	----------------
	*/
	
	} else {
		$enviar_imagen = $db->query("INSERT INTO `imagenes` (`ruta`) VALUES ('".$name."')");
			
		#Busca el idimagen de la tabla imagenes para luego usar el id en la tabla publicaciones
		if ($idimage_f = $db->query("SELECT idimagenes, ruta FROM imagenes WHERE ruta = '".$name."'")) {
			$idimagen = $idimage_f->fetch_array();
		}
		
		#Envio de la publicacion a la DB en la tabla publicaciones
		$enviar_nota = $db->query("INSERT INTO `publicaciones` (`cuentas_idcuenta`, `publicacion`, `imagenes_idimagenes`) VALUES ('".$pf['idcuenta']."','".$publicacion."','".$idimagen['idimagenes']."')");
		
		move_uploaded_file($imagen['tmp_name'], $ruta.$name);
		echo "Finalizado";
		}
	} else {
		header('Location: ?p=404');
		}