<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php echo ucwords($prop['nombre']); ?></title>
    <?php 
	/*
		Load CSS
	*/
	include("temas/$prop[tema]/css/config_css.php");
	?>
    <script src="<?php echo "temas/".$prop['tema'];?>/js/jquery-1.11.0.min.js"></script>
	<script src="<?php echo "temas/".$prop['tema'];?>/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="."><?php echo $prop['nombre'];?></a>
        </div>
        <div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
              <li><a href=".">Inicio</a></li>
              <li><a href="?p=explorar">Explora</a></li>
    		</ul>
        <?php if (!isset($_SESSION['username'])) { ?>
          <div class="navbar-form navbar-right">
            <div class="btn-group">
              <button type="button" class="btn btn-warning"  onclick="document.location.href='?p=login'">Iniciar sesión</button>
              <button type="submit" class="btn btn-danger" onclick="document.location.href='?p=registro'">Crear cuenta</button>
            </div>
          </div>
          <?php } else {?>
          <div class="navbar-form navbar-right">
            <button type="button" class="btn btn-primary"  onclick="document.location.href='?p=publicar'">
            	Publica
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-warning">
                <?php echo " ".$pf['nombres']." ".$pf['apellidos']?>
              </button>
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-cog"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="?p=configuracion">Configuración</a></li>
                <li><a href="?p=opciones">Opciones</a></li>
                <li class="divider"></li>
                <li><a href="?p=cerrar_sesión">Cerrar sesión</a></li>
  			</ul>
            </div>
          </div>
          <?php }?>
          <form class="navbar-form navbar-left input-group">
          <div class="input-group">
          	<input type="text" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-warning" type="button">Buscar</button>
            </span>
          </div>
          </form>
        </div>
      </div>
    </div>