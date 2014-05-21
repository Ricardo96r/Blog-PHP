 <div class="well-bl-1">
	<?php
    if (!isset($_SESSION['username'])) {
        if (!isset($_POST['login_lg'])) {
    ?>
<div class="row">
	<div class="col-xs-12">
   <form method="post" action="">
   <p>
        <label for="login-form-email" id="login-form-label">
            Email:
        </label>
        <input class="form-control" type="email" name="email2" placeholder="email" id="login-form-email" required>
        
        <label for="login-form-contraseña" id="login-form-label">
            Contraseña:
        </label>
        <input class="form-control" type="password" name="contraseña2" id="login-form-contraseña" placeholder="contraseña" required>
        <div id="login-form-ncsesion">
            <input type="checkbox" name="ncsesion2" id="login-form-ncsesion-input" value="1">
            <label for="login-form-ncsesion-input" id="login-form-label">
                No cerrar sesión
            </label>
        </div>
        <input class="btn btn-warning form-control" type="submit" name="login_lg" value="Entrar">
        </p>
    </form>
    <div class="text-center">
        <a href="#">¿Olvidaste tu contraseña?</a>
    </div>
    </div>
</div>
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
        header("Location: ?p=404");
    }
    ?>
	</div>