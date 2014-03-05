<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title><?php echo ucwords($prop['nombre']); ?></title>
    <link rel="stylesheet" type="text/css"  href="<?php echo $prop['tema'];?>/includes/css/estilos.css">
	<script src="http://code.jquery.com/jquery-1.9.0.js" type="text/javascript"></script>
    <script src="includes/js/slider.js"></script>
</head>
<div class="contenedor">
	<header>
    	<div id="titulo">
            <hgroup>
				 <?php echo ucwords($prop['nombre']); ?>
            </hgroup>
         </div>
         <div id="entrar">
		 	<?php
			if (!isset($_SESSION['username'])) {
            	if (!isset($_POST['entrar_logueo'])) {
            ?>
               <form method="post" action="">
                   <table width="335" border="0">
                     <tr>
                       <td width="60"><label for="email">Email:</label></td>
                       <td width="84"><label for="contraseña">Contraseña:</label></td>
                       <td width="42">&nbsp;</td>
                     </tr>
                     <tr>
                       <td><input type="email" name="email" id="email" placeholder="email" required></td>
                       <td><input type="password" name="contraseña" id="contraseña" placeholder="contraseña" required></td>
                       <td><input type="submit" name="entrar_logueo" id="submit" value="Entrar"></td>
                     </tr>
                     <tr>
                       <td><input type="checkbox" name="ncsesion" id="ncsesion" value="1">
                        <label for="ncsesion"> No cerrar sessión</label></td>
                       <td><a href="#">¿Olvidaste tu contraseña?</a></td>
                       <td>&nbsp;</td>
                     </tr>
                   </table>
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
						header("Location: ?".$prop[nombre]."=principal&page=login_error");
						}
				} else {
					header("Location: ?".$prop[nombre]."=principal&page=login_error");
					}	
				}
		} else {
			echo $_SESSION['username'];
			?>
            <br>
            <a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=cerrar_sesión">Cerrar sesión</a>
            <a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=perfil">Perfil</a>
            <a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=opciones">Opciones</a>
            <?php
			}
			?>
         </div>
    	    <nav>
    	      <ul>
              <?php 
			  if(!isset($_SESSION['username'])) {
			  ?>
    	        <li><a href="?<?php echo $prop['nombre'];?>=principal">Inicio</a></li>
    	        <li><a href="?<?php echo $prop['nombre'];?>=principal&amp;page=registro">Registro</a></li>
                <?php
                } else {
                ?>
                <li><a href="?<?php echo $prop['nombre'];?>=principal">Inicio</a></li>
                <li><a href="?<?php echo $prop['nombre'];?>=principal&amp;page=top">Top</a></li>
                <li><a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=enviar_nota">Enviar</a></li>
    	        <li><a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=moderar">Descubre</a></li>
                <?php 
				}
				?>
			</ul>
		</nav>
	</header>
<section>