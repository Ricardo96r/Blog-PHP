<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title><?php echo ucwords($prop['nombre']); ?></title>
    <?php 
	/*
		Load CSS
	*/
	include("temas/$prop[tema]/css/config_css.php");
	?>
	<script src="<?php echo "temas/".$prop['tema'];?>/js/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script src="<?php echo "temas/".$prop['tema'];?>/js/header.js"></script>
    <script src="<?php echo "temas/".$prop['tema'];?>/js/ubuntu.js"></script>
</head>
<body>
	<header>
    	<div id="header-content-left">
    	<div id="header-nav_boton">
        	<button id="nav_boton">
            	<div id="header-nav_boton-div"></div>
                <div id="header-nav_boton-div"></div>
                <div id="header-nav_boton-div"></div>
            </button>
        </div>
        <div id="header-titulo">
			<button id="titutlo-boton" onClick="window.location.href='.'">
                <div id="titulo-logo">
                	N
                </div>
                <div id="titulo-text">
					ombre
               	</div>
            </button>
		</div>
        </div>
        <div id="header-content-right">
        <div id="header-buscador">
        <form method="post" action="">
        	<div id="header-buscador-input-div">
            	<input type="text" name="header-buscador-input" id="header-buscador-input" placeholder="Buscar">
            </div>
            <div id="header-buscador-submit-div">
            	<input name="header-buscador-submit"  id="header-buscador-submit" type="image" src="temas/<?php echo $prop['tema'];?>/imagenes/buscar.png">
            </div>
        </form>
        </div>
        <?php if(!isset($_SESSION['username'])) {?>
		<div id="create_acc">
			<button id="create-boton" onClick="window.location.href='?p=registro'">Crear cuenta</button>
		</div>
		<div id="login">
			<button id="login-boton">Iniciar sesión</button>
		</div>
        <?php } else { ?>
        <div id="header-propieades">
			<button id="boton-propiedades"><img src="temas/<?php echo $prop['tema'];?>/imagenes/opciones.png"></button>
		</div>
        <div id="header-perfil">
			<button id="boton-perfil" onClick="window.location.href='?p=perfil&pf=<?php echo $pf['cuenta'];?>'">
                <div id="header-perfil-imagen">
                	<img src="static-content/perfiles/<?php echo $pf['imagen_perfil']?>">
                </div>
                <div id="header-perfil-nombre">
					<?php echo $pf['nombres']." ".$pf['apellidos']?>
               	</div>
            </button>
		</div>
        <?php } ?>
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
                        <div id="menu-entrar-submit-div">
                            <input type="submit" name="entrar_logueo" id="menu-entrar-submit" value="Entrar">
                        </div>
                    </div>
               </form>
           <?php 
				} else {
					$sesion = mysql_query("SELECT email, contraseña, nombres, apellidos FROM cuentas WHERE email = '$_POST[email]'");
					$sesion1 = mysql_fetch_array($sesion);
	
					if (isset($_POST["email"]) and !empty($_POST["email"]) and
						isset($_POST["contraseña"]) and !empty($_POST["contraseña"])) {
						if ($_POST["contraseña"] === $sesion1["contraseña"]) {
							$_SESSION["username"] = $_POST["email"];
							echo "Conectando a la web";
							header("Location: ".$_SERVER['HTTP_REFERER']);
							
						} else {
							header("Location: ?p=login");
							}
					} else {
						header("Location: ?p=login");
						}	
					}
			} else {?>
                <div id="header-menu-propiedades">
                	<ul>
                        <li><a href="?p=opciones">Configuración</a></li>
                        <li><a href="?p=cerrar_sesión">Cerrar sesión</a></li>
                    </ul>
                </div>
			<?php }?>
         </div>
         </div>
	</header>
    <div class="contenedor">