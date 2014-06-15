<?php if (isset($_SESSION['username'])) {?>
<div class="well-bl-form">
<h1>Configuración:</h1>
	<h4>Cambiar imagen de perfil:</h4>
    <div class="img-responsive center-block" style="max-width:260px; min-width: 40px;">
        <a class="thumbnail"  data-toggle="modal" data-target="#editar_perfil">
          <img src="static-content/perfiles/<?php echo $pf['imagen_perfil']?>">
        </a>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editar_perfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Editar foto de perfil<small> Solo imagenes cuadradas!</small></h4>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data" method="post" class="form-perfil-imagen">
                <div class="form-group" id="publicar-form-file">
                <input name="img_pf" type="file" class="form-control perfil_imagen_cambiar" id="publicar-form-file-input">
                    <div class="img-responsive" id="publicar-form-file-text">
                    	<button type="button" class="btn btn-warning btn-lg">
                            <span class="glyphicon glyphicon-camera"></span>
                            <div>Subir imagen de perfil</div>
						</button>
                    </div>
                </div>
                <script src="<?php echo 'temas/'.$prop['tema'];?>/js/publicar.js"></script>
			</form>
            <div id="resultado"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button class="btn btn-warning" id="imagen_perfil-submit">Cambiar imagen de perfil</button>
          </div>
        </div>
      </div>
    </div>
    <script src="<?php echo 'temas/'.$prop['tema'];?>/ajax/js/configuracion_perfil_imagen.js"></script>
    <h4>Cambiar fondo de perfil:</h4>
    </div>
<?php } else {
	header ('Location: ?p=404');
	}