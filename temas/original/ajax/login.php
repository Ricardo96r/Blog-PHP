<?php
	if (isset($_POST['permiso']) and $_POST['permiso'] == "allowed") {
		$sesion = mysql_query("SELECT email, contraseña FROM cuentas WHERE email = '$_POST[email2]'");
        $sesion1 = mysql_fetch_array($sesion);
        if (isset($_POST["email2"]) and !empty($_POST["email2"]) and
            isset($_POST["contraseña2"]) and !empty($_POST["contraseña2"])) {
            if ($_POST["contraseña2"] === $sesion1["contraseña"]) {
                $_SESSION["username"] = $_POST["email2"];
                echo "Conectando...";
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
?>
