<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title><?php echo ucwords($prop['nombre']); ?></title>
    <link rel="stylesheet" type="text/css"  href="<?php echo $prop['tema'];?>/includes/css/css-reset.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo $prop['tema'];?>/includes/css/header.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo $prop['tema'];?>/includes/css/nav.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo $prop['tema'];?>/includes/css/estilos.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo $prop['tema'];?>/includes/css/aside.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo $prop['tema'];?>/includes/css/footer.css">
	<script src="http://code.jquery.com/jquery-1.9.0.js" type="text/javascript"></script>
    <script src="<?php echo $prop['tema'];?>/includes/js/header.js"></script>
    <script src="//use.edgefonts.net/ubuntu.js"></script>
</head>
<body>
	<header>
    	<div id="header-content-left">
    	<div id="header-nav_boton">
        	<button id="nav_boton">
            	&darr;
            </button>
        </div>
    	<div id="header-titulo">
            <button id="titulo" onClick="window.location.href='?<?php echo $prop['nombre']; ?>=principal'">
            	<?php echo ucwords($prop['nombre']); ?>
			</button>
		</div>
        </div>
        <div id="header-content-right">
        <?php if(!isset($_SESSION['username'])) {?>
		<div id="create_acc">
			<button id="create-boton" onClick="window.location.href='?<?php echo $prop['nombre']; ?>=principal&page=registro'">crear cuenta</button>
		</div>
		<div id="login">
			<button id="login-boton">Iniciar sesión &darr;</button>
		</div>
        <?php } else { ?>
        <div id="header-propieades">
			<button id="boton-propiedades">Propieades&darr;</button>
		</div>
        <div id="header-perfil">
			<button id="boton-perfil" onClick="window.location.href='?<?php echo $prop['nombre']; ?>=usuario&page=perfil&pf=<?php echo $pf['cuenta'];?>'">
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
                        <div>
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
							header("Location: ?".$prop[nombre]."=principal&page=login");
							}
					} else {
						header("Location: ?".$prop[nombre]."=principal&page=login");
						}	
					}
			} else {?>
                <div id="header-menu-propiedades">
                	<ul>
                        <li><a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=cerrar_sesión">Cerrar sesión</a></li>
                        <li><a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=perfil">Perfil</a></li>
                        <li><a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=opciones">Opciones</a></li>
                    </ul>
                </div>
			<?php }?>
         </div>
         </div>
	</header>
    <div class="contenedor">