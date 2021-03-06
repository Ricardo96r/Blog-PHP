<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php echo ucwords($prop['nombre']);?></title>
    <?php
	/*
		Load CSS
	*/
	include('temas/'.$prop['tema'].'/css/config_css.php');
	?>
</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top" id="height-nav" role="navigation"><div class="container"><div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="."><img class="img-responsive pull-left" src="static-content/logo.png" style="width:30px; margin-right:5px;"> Nombre</a>
        <?php if (rango() == 0) { ?>
		<div class="visible-xs pull-right navbar-xs">
            <div class="btn-group">
                <button type="button" class="btn btn-warning"  onclick="document.location.href='?p=login'">
                <span class="glyphicon glyphicon-info-sign"></span></button>
                <button type="submit" class="btn btn-danger" onclick="document.location.href='?p=registro'">
                <span class="glyphicon glyphicon-hand-right"></span> Crear cuenta</button>
            </div>
		</div>
		<?php } else {?>
		<div class="visible-xs pull-right navbar-xs">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#publicar">
            	<span class="glyphicon glyphicon-edit"></span>
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
                    <li><a href="?p=seguridad"><span class="glyphicon glyphicon-lock"></span> Seguridad</a></li>
                    <li class="divider"></li>
                    <li><a href="?p=cerrar_sesión"><span class="glyphicon glyphicon-off"></span> Cerrar sesión</a></li>
                </ul>
            </div>
		</div>
	<?php }?>
	</div>
	<div class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
        <ul class="nav navbar-nav">
          <li <?php if($page == ''){echo'class=edit';}?>><a href="."><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
          <li <?php if($page == 'explorar'){echo'class=edit';}?>><a href="?p=explorar"><span class="glyphicon glyphicon-list-alt"></span> Explora</a></li>
          <li class="visible-xs"><a href="?p=buscar"><span class="glyphicon glyphicon-search"></span> Buscar</a></li>
        </ul>
        <?php if (rango() == 0) { ?>
		<div class="navbar-form navbar-right hidden-xs">
            <button class="btn btn-warning" type="button" onclick="document.location.href='?p=buscar'">
            <span class="glyphicon glyphicon-search"></span></button>
            <div class="btn-group">
              <button type="button" class="btn btn-warning"  onclick="document.location.href='?p=login'"><span class="glyphicon glyphicon-info-sign"></span> Iniciar sesión</button>
              <button type="submit" class="btn btn-danger" onclick="document.location.href='?p=registro'"><span class="glyphicon glyphicon-hand-right"></span> Crear cuenta</button>
            </div>
		</div>
		<?php } else {?>
        <div class="navbar-form navbar-right hidden-xs">
            <button class="btn btn-warning" type="button" onclick="document.location.href='?p=buscar'">
            <span class="glyphicon glyphicon-search"></span></button>
            <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#publicar">
                <span class="glyphicon glyphicon-edit"></span> Publica
            </button>
            <div class="btn-group">
                <button type="button" class="btn btn-warning" onclick="document.location.href='?p=perfil&pf=<?php echo $pf['cuenta'];?>'">
                    <span class="glyphicon glyphicon-user"></span>
                </button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-cog"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="?p=configuracion"><span class="glyphicon glyphicon-wrench"></span> Configuración</a></li>
                    <li><a href="?p=seguridad"><span class="glyphicon glyphicon-lock"></span> Seguridad</a></li>
                    <li class="divider"></li>
                    <li><a href="?p=cerrar_sesión"><span class="glyphicon glyphicon-off"></span> Cerrar sesión</a></li>
                </ul>
            </div>
		</div>
		<?php }?>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="publicar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></button>
        <h4 class="modal-title" id="myModalLabel"><strong>Publicar</strong></h4>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" method="post" class="form-publicacion">
            <blockquote class="form-group"><div id="text_publicacion">
            <textarea name="publicacion" class="form-control" id="publicacion" maxlength="200" placeholder="Escribe algo sobre la publicacion..."></textarea>
            </div></blockquote>
            <div class="form-group upload-form-file" id="upload-publicacion">
            <input name="publicacion_img_input" type="file" class="form-control upload-form-file-input" id="publicacion_img" accept="image/x-png, image/gif, image/jpeg">
                <div class="img-responsive" id="img_publicacion">
                    <button type="button" class="btn btn-warning btn-lg">
                        <span class="glyphicon glyphicon-camera"></span>
                        <div>Subir publicación</div>
                    </button>
                </div>
            </div>
        </form>
        <div id="resultado_publicacion"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-warning" id="publicacion-submit">Enviar publicación.</button>
      </div>
    </div>
  </div>
</div>