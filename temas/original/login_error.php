 <div class="fondo" id="login">
	<?php
    if (!isset($_SESSION['username'])) {
        if (!isset($_POST['login_lg'])) {
    ?>
       <form method="post" action="">
           <table width="335" border="0">
             <tr>
               <td width="60"><label for="email2">Email:</label></td>
               <td width="84"><label for="contraseña2">Contraseña:</label></td>
               <td width="42">&nbsp;</td>
             </tr>
             <tr>
               <td><input type="email" name="email2" id="email2" placeholder="email" required></td>
               <td><input type="password" name="contraseña2" id="contraseña2" placeholder="contraseña" required></td>
               <td><input type="submit" name="login_lg" id="login_lg" value="Entrar"></td>
             </tr>
             <tr>
               <td><input type="checkbox" name="ncsesion2" id="ncsesion2" value="1">
                <label for="ncsesion2"> No cerrar sessión</label></td>
               <td><a href="#">¿Olvidaste tu contraseña?</a></td>
               <td>&nbsp;</td>
             </tr>
           </table><br>
           <div>
                Email o contraseña erroneas*
           </div>
       </form>
    <?php 
    } else {
        $sesion = mysql_query("SELECT email, contraseña FROM cuentas WHERE email = '$_POST[email2]'");
        $sesion1 = mysql_fetch_array($sesion);
    
        if (isset($_POST["email2"]) and !empty($_POST["email2"]) and
            isset($_POST["contraseña2"]) and !empty($_POST["contraseña2"])) {
            if ($_POST["contraseña2"] === $sesion1["contraseña"]) {
                $_SESSION["username"] = $_POST["email2"];
                echo "Conectando a la web";
                header("Location: ".$_SERVER['HTTP_REFERER']);
                
            } else {
                header("Location: ?p=login");
                echo "Contraseña incorrecta o email incorrecto";
                }
            } else {
                header("Location: ?p=login");
                echo "Alguno de los campos esta vacio";
                }	
            } 
    } else { 
        header("Location: ");
    }
    ?>
</div>