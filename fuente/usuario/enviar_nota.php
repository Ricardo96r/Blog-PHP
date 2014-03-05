<div id="cont">
<?php
if(isset($_SESSION['username'])) {
	if(!isset($_POST['enviar_nota'])) {
		?>
        Escribe una nota:<br>
        <form method="post" action="">
            <input type="text" name="nota" maxlength="400" required>
            <input type="submit" name="enviar_nota" value="enviar nota">
        </form>
        <?php
		} else {
			$idcuentap = mysql_query("SELECT idcuentas, email FROM cuentas WHERE email = '$_SESSION[username]'");
			$idcuentap2 = mysql_fetch_array($idcuentap);
			$idcuenta = $idcuentap2['idcuentas'];
			$nota = antiSqlInjection($_POST['nota']);
			if(!isset($nota) and empty($nota)) {
				echo "Porfavor no deje campos vacios";
			} elseif(strlen($nota) < 20) {
				echo "La nota es muy corta, tiene que tener mas de 20 caracteres";
			} elseif(strlen($nota) > 400){
				echo "La nota es muy larga, el máximo de caracteres es 400";
			} else {
			$enviar_nota = mysql_query("INSERT INTO `notas` (`cuentas_idcuentas`, `nota`) VALUES ('".$idcuenta."','".$nota."')") or die (mysql_error());
			echo "nota enviada";
				}
			}
} else {
	echo "Tu no has iniciado sesión";
	
	}
?>
</div>