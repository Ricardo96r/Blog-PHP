<div class="fondo" id="publicar">
<?php
if(isset($_SESSION['username'])) {
	if(!isset($_POST['enviar_nota'])) {
		?>
		<div id="publicar-form">
			<form enctype="multipart/form-data" method="post" action="">
				<input name="uploadedfile" type="file" id="publicar-form-file">
				<textarea name="nota" id="publicar-form-publicacion"></textarea>
				<input type="submit" name="enviar_nota" value="ENVIAR PUBLICACIÓN" id="publicar-form-submit">
			</form>
        </div>
        <?php
		} else {
			$idcuentap = mysql_query("SELECT idcuenta, email FROM cuentas WHERE email = '$_SESSION[username]'");
			$idcuentap2 = mysql_fetch_array($idcuentap);
			$idcuenta = $idcuentap2['idcuenta'];
			$nota = antiSqlInjection($_POST['nota']);
			
			if(!isset($nota) and empty($nota)) {
				echo "Porfavor no deje campos vacios";
			} elseif(strlen($nota) < 20) {
				echo "La nota es muy corta, tiene que tener mas de 20 caracteres";
			} elseif(strlen($nota) > 400){
				echo "La nota es muy larga, el máximo de caracteres es 400";
			} else {
			$enviar_nota = mysql_query("INSERT INTO `publicaciones` (`cuentas_idcuenta`, `publicacion`) VALUES ('".$idcuenta."','".$nota."')") or die (mysql_error());
			echo "nota enviada";
				}
			}
} else {
	echo "Tu no has iniciado sesión";
	
	}
?>
</div>