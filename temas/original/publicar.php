<div class="fondo" id="publicar">
	<div class="well-bl-1">
		<div class="row">
			<div class="col-md-12">
<?php
if(rango() >= 1) {
	if(!isset($_POST['enviar_nota'])) {
		?>
			<form enctype="multipart/form-data" method="post" action="">
                <div id="publicar-form-file">
                    <input name="archivo" type="file" id="publicar-form-file-input">
                    <div class="img-responsive" id="publicar-form-file-text">
                    	<button type="button" class="btn btn-warning btn-lg">
                            <span class="glyphicon glyphicon-camera"></span>
                            <div>Subir publicación</div>
						</button>
                    </div>
                </div>
                <script src="<?php echo 'temas/'.$prop['tema'];?>/js/publicar.js"></script>
				<textarea name="nota" class="form-control" maxlength="200" placeholder="Escribe algo..."></textarea>
				<input class="btn btn-warning form-control" type="submit" name="enviar_nota" value="Enviar publicación">
			</form>
        <?php
		} else {
			?><div id="publicar-form"><?php
			if ($idcuentap = $db->query("SELECT idcuenta, email FROM cuentas WHERE email = '".$_SESSION['username']."'")) {
				$idcuentap2 = $idcuentap->fetch_array();
			}
			$idcuenta = $idcuentap2['idcuenta'];
			$nota = depurar($_POST['nota']);
			$ruta = 'static-content/publicaciones/';
			if ($name_m = $db->query('SELECT idimagenes FROM imagenes')) {
				$name = ($name_m->num_rows + 1).'-'.rand();
			}
			
			/*
				Errores
			*/
			if(!isset($nota) and empty($nota)) {
				echo 'Porfavor no deje campos vacios';
			} elseif(strlen($nota) < 20) {
				echo 'La nota es muy corta, tiene que tener mas de 20 caracteres';
			} elseif(strlen($nota) > 200) {
				echo 'La nota es muy larga, el máximo de caracteres es 200';
			} elseif($_FILES['archivo']['size'] > 6000000) {
				echo 'Foto invalida, la imagen exede los 5MB!';
			} elseif($_FILES['archivo']['error'] > 0) {
				echo 'Error al subir la imagen!';
			/*} elseif (($_FILES['archivo']['type'] != 'image/*') and ($_FILES['archivo']['type'] = 'image/gif')) {
				echo 'Solo puede subir imagenes exeptuando los gifs!';*/
			} elseif(file_exists($ruta.$name)) {
				echo 'Error anormal, reporte. Intente nuevamente.';
			
			/*
				Accion realizada cuando no se encuentran errores mencionados arriba
			*/
			} else {
			#Agrega la imagen a la base de datos en una tabla unica
			$enviar_imagen = $db->query("INSERT INTO `imagenes` (`ruta`) VALUES ('".$name."')");
			
			#Busca el idimagen de la tabla imagenes para luego usar el id en la tabla publicaciones
			if ($idimage_f = $db->query("SELECT idimagenes, ruta FROM imagenes WHERE ruta = '".$name."'")) {
				$idimagen = $idimage_f->fetch_array();
			}
			
			#Envio de la publicacion a la DB en la tabla publicaciones
			$enviar_nota = $db->query("INSERT INTO `publicaciones` (`cuentas_idcuenta`, `publicacion`, `imagenes_idimagenes`) VALUES ('".$idcuenta."','".$nota."','".$idimagen['idimagenes']."')");
			move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta.$name);
			?>
            <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>¡Publicación enviada!</strong>
            </div>
			<?php
			echo '<img class=img-responsive src='.$ruta.$name.'>';
			echo $nota;
				}
				?></div><?php
			}
} else {
	header('Location: ?p=404');
	}
?>
            </div>
		</div>
	</div>
</div>