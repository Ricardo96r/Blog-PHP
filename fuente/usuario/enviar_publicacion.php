<div id="enviar_publicacion">
<?php
if(isset($_SESSION['username'])) {
	if(!isset($_POST['enviar_nota'])) {
		?>
    
        	<div id="enviar_publicacion_texto">
        		Manda una publicacion:
            </div>
            <div id="enviar_publicacion_form">
                <form enctype="multipart/form-data" method="post" action="">
                	<input name="uploadedfile" type="file" />
                    <textarea name="nota" rows="4" cols="100%"></textarea><br>
                    <input type="submit" name="enviar_nota" value="enviar nota" id="enviar_publicacion_submit-boton">
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