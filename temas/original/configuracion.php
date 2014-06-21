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
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></button>
            <h4 class="modal-title" id="myModalLabel">Cambiar imagen de perfil<small> Solo imagenes cuadradas!</small></h4>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data" method="post" class="form-perfil-imagen">
                <div class="form-group upload-form-file" id="upload_pf_img-form-file">
                <input name="img_pf" type="file" class="form-control upload-form-file-input perfil_imagen_cambiar" accept="image/x-png, image/gif, image/jpeg">
                    <div class="img-responsive" id="img_pf_cambiar">
                    	<button type="button" class="btn btn-warning btn-lg">
                            <span class="glyphicon glyphicon-camera"></span>
                            <div>Subir imagen de perfil</div>
						</button>
                    </div>
                </div>
			</form>
            <div id="resultado_pf_img"></div>
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
    <div class="img-responsive center-block" style="max-width:260px; min-width: 40px;">
        <a class="thumbnail"  data-toggle="modal" data-target="#editar_perfil_fondo">
          <img src="static-content/perfiles_fondo/<?php echo $pf['imagen_perfil_fondo']?>">
        </a>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editar_perfil_fondo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></button>
            <h4 class="modal-title" id="myModalLabel">Cambiar fondo de perfil</h4>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data" method="post" class="form-perfil-imagen">
                <div class="form-group upload-form-file" id="upload_pf_fondo_img-form-file">
                <input name="img_pf" type="file" class="form-control upload-form-file-input" id="perfil_imagen_fondo_cambiar" accept="image/x-png, image/gif, image/jpeg">
                    <div class="img-responsive" id="img_pf_fondo_cambiar">
                    	<button type="button" class="btn btn-warning btn-lg">
                            <span class="glyphicon glyphicon-camera"></span>
                            <div>Subir imagen de perfil</div>
						</button>
                    </div>
                </div>
			</form>
            <div id="resultado_pf_fondo_img"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button class="btn btn-warning" id="imagen_perfil_fondo-submit">Cambiar imagen de perfil.</button>
          </div>
        </div>
      </div>
    </div>
    <script src="<?php echo 'temas/'.$prop['tema'];?>/ajax/js/configuracion_perfil_imagen_fondo.js"></script>
    </div>
<?php } else {
	header ('Location: ?p=404');
	}