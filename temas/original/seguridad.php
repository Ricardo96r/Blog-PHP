<?php if (isset($_SESSION['username'])) {?>
<div class="well-bl-form">
<div class="page-header">
<h1>Seguridad</h1>
</div>
	<h5><div class="btn btn-warning" data-toggle="modal" data-target="#cambiar_contraseña"><span class="glyphicon glyphicon-pencil"></span> Cambiar contraseña</div></h5>
    <!-- Modal -->
    <div class="modal fade" id="cambiar_contraseña" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></button>
            <h4 class="modal-title" id="myModalLabel">Cambiar contraseña</h4>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data" method="post" class="form-perfil-imagen">
                <div class="form-group upload-form-file" id="upload_pf_img-form-file">
                <input name="img_pf" type="file" class="form-control upload-form-file-input perfil_imagen_cambiar" accept="image/x-png, image/gif, image/jpeg">
                    <div class="img-responsive" id="img_pf_cambiar">
                    	<button type="button" class="btn btn-warning btn-lg">
                            <span class="glyphicon glyphicon-camera"></span>
                            <div>Cambiar imagen de perfil</div>
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
</div>
<?php } else {
	header ('Location: ?p=404');
	}