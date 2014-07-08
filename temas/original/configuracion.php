<?php if (isset($_SESSION['username'])) {?>
<div class="well-bl-form">
<div class="page-header">
<h1>Configuración</h1>
</div>
	<h5><div class="btn btn-warning" data-toggle="modal" data-target="#editar_perfil"><span class="glyphicon glyphicon-pencil"></span> Cambiar imagen de perfil</div></h5>
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
    <h5><div class="btn btn-warning" data-toggle="modal" data-target="#editar_perfil_fondo"><span class="glyphicon glyphicon-pencil"></span> Cambiar fondo de perfil</div></h5>
    <!-- Modal -->
    <div class="modal fade" id="editar_perfil_fondo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></button>
            <h4 class="modal-title" id="myModalLabel">Cambiar fondo de perfil</h4>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data" method="post" class="form-perfil_fondo-imagen">
                <div class="form-group upload-form-file" id="upload_pf_fondo_img-form-file">
                <input name="img_pf" type="file" class="form-control upload-form-file-input" id="perfil_imagen_fondo_cambiar" accept="image/x-png, image/gif, image/jpeg">
                    <div class="img-responsive" id="img_pf_fondo_cambiar">
                    	<button type="button" class="btn btn-warning btn-lg">
                            <span class="glyphicon glyphicon-camera"></span>
                            <div>Cambiar fondo de perfil</div>
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
    <h5><div class="btn btn-warning" data-toggle="modal" data-target="#editar_nombre"><span class="glyphicon glyphicon-pencil"></span> Editar nombre</div></h5>
    <!-- Modal -->
    <div class="modal fade" id="editar_nombre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></button>
            <h4 class="modal-title" id="myModalLabel">Cambiar nombre</h4>
          </div>
          <div class="modal-body">
            <form method="post">
                <div class="form-group form_nombre_perfil">
					<input class="form-control" id="cambiar_nombre_perfil" type="text" maxlength="20" placeholder="<?php echo $pf['nombre']?>" required>
                </div>
			</form>
            <div id="resultado_nombre_perfil"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button class="btn btn-warning" id="cambiar_nombre_perfil_submit">Cambiar nombre de perfil.</button>
          </div>
        </div>
      </div>
    </div>
    </div>
<?php } else {
	header ('Location: ?p=404');
	}