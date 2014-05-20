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
        <?php if (!isset($_SESSION['username'])) { ?>
          <div class="navbar-form navbar-right">
            <div class="btn-group">
              <a href="?p=login"><button type="button" class="btn btn-warning">Iniciar sesión</button></a>
              <a href="?p=registro"><button type="submit" class="btn btn-danger">Crear cuenta</button></a>
            </div>
          </div>
          <?php } else {?>
          <div class="navbar-form navbar-right">
            <div class="btn-group">
              <a href="?p=login"><button type="button" class="btn btn-warning">
                <img class="img-xs" src="static-content/perfiles/<?php echo $pf['imagen_perfil']?>">
                <?php echo $pf['nombres']." ".$pf['apellidos']?>
              </button></a>
              <a href="?p=registro"><button type="submit" class="btn btn-danger">Crear cuenta</button></a>
            </div>
          </div>
          <?php }?>
          <form class="navbar-form navbar-left input-group">
          <div class="input-group">
          <input type="text" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button">Buscar</button>
            </span>
          </div>
          </form>
        </div>
      </div>
    </div>