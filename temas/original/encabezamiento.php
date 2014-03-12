<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title><?php echo ucwords($prop['nombre']); ?></title>
    <link rel="stylesheet" type="text/css"  href="<?php echo $prop['tema'];?>/includes/css/css-reset.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo $prop['tema'];?>/includes/css/estilos.css">
	<script src="http://code.jquery.com/jquery-1.9.0.js" type="text/javascript"></script>
    <script src="<?php echo $prop['tema'];?>/includes/js/header.js"></script>
</head>
	<header>
    	<div id="header-titulo">
            <button id="titulo" onClick="window.location.href='?<?php echo $prop['nombre']; ?>=principal'">
            	<?php echo ucwords($prop['nombre']); ?>
			</button>
		</div>
		<div id="create_acc">
			<button id="create-boton" onClick="window.location.href='?<?php echo $prop['nombre']; ?>=principal&page=registro'">crear cuenta</button>
		</div>
		<div id="login">
			<button id="login-boton">iniciar sesión &darr;</button>
		</div>
		<div id="entrar">
			<?php
			if (!isset($_SESSION['username'])) {
            	if (!isset($_POST['entrar_logueo'])) {
            ?>
               <form method="post" action="">
                    <div><input type="email" name="email" id="menu-entrar-email" placeholder="email" required></div>
                    <div><input type="password" name="contraseña" id="menu-entrar-password" placeholder="contraseña" required></div>
                    <div id="menu-entrar-ncsesion_submit">
                        <div id="menu-entrar-ncsesion-div">
                            <input type="checkbox" name="ncsesion" id="menu-entrar-ncsesion" value="1"><label for="menu-entrar-ncsesion"> No cerrar sesión</label>
                        </div>
                        <div>
                            <input type="submit" name="entrar_logueo" id="menu-entrar-submit" value="Entrar">
                        </div>
                    </div>
               </form>
           <?php 
				} else {
					$sesion = mysql_query("SELECT email, contraseña FROM cuentas WHERE email = '$_POST[email]'");
					$sesion1 = mysql_fetch_array($sesion);
	
					if (isset($_POST["email"]) and !empty($_POST["email"]) and
						isset($_POST["contraseña"]) and !empty($_POST["contraseña"])) {
						if ($_POST["contraseña"] === $sesion1["contraseña"]) {
							$_SESSION["username"] = $_POST["email"];
							echo "Conectando a la web";
							header("Location: ".$_SERVER['HTTP_REFERER']);
							
						} else {
							header("Location: ?".$prop[nombre]."=principal&page=login");
							}
					} else {
						header("Location: ?".$prop[nombre]."=principal&page=login");
						}	
					}
			} else {
				echo $_SESSION['username'];?>
				<br>
				<a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=cerrar_sesión">Cerrar sesión</a>
				<a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=perfil">Perfil</a>
				<a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=opciones">Opciones</a>
				<?php
				}
				?>
         </div>
	</header>
    <div class="contenedor">