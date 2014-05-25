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
    <script src="<?php echo "temas/".$prop['tema'];?>/js/javascript.js"></script>
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
                  <?php if (!isset($_SESSION['username'])) { ?>
          <div class="visible-xs pull-right navbar-xs">
            <div class="btn-group">
              <button type="button" class="btn btn-warning"  onclick="document.location.href='?p=login'"><span class="glyphicon glyphicon-info-sign"></span> Iniciar sesión</button>
              <button type="submit" class="btn btn-danger" onclick="document.location.href='?p=registro'"><span class="glyphicon glyphicon-hand-right"></span> Crear cuenta</button>
            </div>
          </div>
          <?php } else {?>
          <div class="visible-xs pull-right navbar-xs">
            <button type="button" class="btn btn-primary"  onclick="document.location.href='?p=publicar'">
            	<span class="glyphicon glyphicon-edit"></span> Publica
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-warning" onclick="document.location.href='?p=perfil&pf=<?php echo $pf['cuenta'];?>'">
                <span class="glyphicon glyphicon-user"></span>
              </button>
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-cog"></span>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a href="?p=configuracion"><span class="glyphicon glyphicon-wrench"></span> Configuración</a></li>
                <li><a href="?p=opciones"><span class="glyphicon glyphicon-lock"></span> Seguridad</a></li>
                <li class="divider"></li>
                <li><a href="?p=cerrar_sesión"><span class="glyphicon glyphicon-off"></span> Cerrar sesión</a></li>
  			</ul>
            </div>
          </div>
          <?php }?>
        </div>
        
        <div class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<ul class="nav navbar-nav">
              <li><a href="."><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
              <li><a href="?p=explorar"><span class="glyphicon glyphicon-list-alt"></span> Explora</a></li>
    		</ul>
        <?php if (!isset($_SESSION['username'])) { ?>
          <div class="navbar-form navbar-right hidden-xs">
            <div class="btn-group">
              <button type="button" class="btn btn-warning"  onclick="document.location.href='?p=login'"><span class="glyphicon glyphicon-info-sign"></span> Iniciar sesión</button>
              <button type="submit" class="btn btn-danger" onclick="document.location.href='?p=registro'"><span class="glyphicon glyphicon-hand-right"></span> Crear cuenta</button>
            </div>
          </div>
          <?php } else {?>
          <div class="navbar-form navbar-right hidden-xs">
            <button type="button" class="btn btn-primary"  onclick="document.location.href='?p=publicar'">
            	<span class="glyphicon glyphicon-edit"></span> Publica
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-warning" onclick="document.location.href='?p=perfil&pf=<?php echo $pf['cuenta'];?>'">
                <span class="glyphicon glyphicon-user"></span> <?php echo " ".$pf['nombres']." ".$pf['apellidos']?>
              </button>
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-cog"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="?p=configuracion"><span class="glyphicon glyphicon-wrench"></span> Configuración</a></li>
                <li><a href="?p=opciones"><span class="glyphicon glyphicon-lock"></span> Seguridad</a></li>
                <li class="divider"></li>
                <li><a href="?p=cerrar_sesión"><span class="glyphicon glyphicon-off"></span> Cerrar sesión</a></li>
  			</ul>
            </div>
          </div>
          <?php }?>
          <div class="navbar-form navbar-left visible-sm">
          	<button class="btn btn-warning" type="button" onclick="document.location.href='?p=buscar'"><span class="glyphicon glyphicon-search"> Buscar</span></button>
          </div>
          <form class="navbar-form navbar-left input-group hidden-sm">
          <div class="input-group">
          	<input type="text" class="form-control" placeholder="Buscar...">
            <span class="input-group-btn">
                <button class="btn btn-warning" type="button"><span class="glyphicon glyphicon-search"></span></button>
            </span>
          </div>
          </form>
        </div>
      </div>
    </div>