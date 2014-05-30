<?php
	# Comienzo de session
	session_start();
	
	# Compresion GZip
	if(!extension_loaded('zlib')){
		ini_set('zlib.output_compression_level', 1);  
		ob_start('ob_gzhandler'); 
	}
	
	if (isset($_SESSION['admin'])) {
		# Cargar configuracion
		require_once("../../../configuracion/database.php");
		require_once("../../../configuracion/propiedades.php");
		require_once("../../../configuracion/funciones.php");
		
	
	# Cargar
	if (isset($_POST['permiso']) and $_POST['permiso'] == "allowed") {
		$sesion = mysql_query("SELECT email, contraseña FROM cuentas WHERE email = '$_POST[email2]'");
        $sesion1 = mysql_fetch_array($sesion);
        if (isset($_POST["email2"]) and !empty($_POST["email2"]) and
            isset($_POST["contraseña2"]) and !empty($_POST["contraseña2"])) {
            if ($_POST["contraseña2"] === $sesion1["contraseña"]) {
                $_SESSION["username"] = $_POST["email2"];
                echo "Conectando a la web";
				header("Location: ?p=explorar");
                
            } else {
				echo "Contraseña incorrecta o email incorrecto";
                }
		} else {
			echo "Alguno de los campos esta vacio";
			}	
	} else {
		echo "No tienes permiso para entrar aqui!";
		}
		mysql_close($conn);
		ob_end_flush();
	} else {
		echo "<div style='text-align:center; font-size:50px;'> TEST WEB</div>";
		//header('location: http://www.hostinger.es/');
		}
?>
