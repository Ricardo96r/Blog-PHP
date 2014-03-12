<div id="contenido">
<?php
if (isset($_GET['pf'])) {
	$perfil_get= antiSqlInjection($_GET['pf']);
  	$perfil_op = mysql_query("
		SELECT idcuentas, cuenta, email, nombres, apellidos, nacimiento, sexo 
		FROM cuentas WHERE cuenta = '$perfil_get'"
		, $conn) or die (mysql_error());
	$perfil = mysql_fetch_array($perfil_op);
} else {
   // REVISAR
}

if (!isset($perfil) or !isset($perfil_get) or empty($perfil) or empty($perfil_get)) {
	header("Location: ?$prop[nombre]=principal");
	} else {
		if($perfil == !NULL) {
			echo $perfil['cuenta'];
		} else {
			header("Location: ?$prop[nombre]=principal");
			}
		
		}
?>
</div>