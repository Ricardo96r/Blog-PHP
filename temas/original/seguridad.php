<?php if (isset($_SESSION['username'])) {?>
<div class="well-bl-form">
<div class="page-header">
<h1>Seguridad</h1>
</div>
	<h5><div class="btn btn-warning" data-toggle="modal" data-target="#cambiar_password"><span class="glyphicon glyphicon-pencil"></span> Cambiar contraseña</div></h5>
    <!--- modal --->
    <div class="modal fade" id="cambiar_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></button>
            <h4 class="modal-title" id="myModalLabel">Cambiar contraseña</h4>
          </div>
          <div class="modal-body">
            <form method="post">
                <div class="form-group form_password_actual">
					<input class="form-control" id="password_actual" type="text" maxlength="20" placeholder="Contraseña actual" required>
                </div>
                <div class="form-group form_password1_cambiar">
					<input class="form-control" id="password1_cambiar" type="text" maxlength="20" placeholder="Nueva contraseña" required>
                </div>
                <div class="form-group form_password2_cambiar">
					<input class="form-control" id="password2_cambiar" type="text" maxlength="20" placeholder="Repetir la nueva contraseña" required>
                </div>
			</form>
            <div id="resultado_password_cambiar"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button class="btn btn-warning" id="cambiar_password_submit">Cambiar contraseña.</button>
          </div>
        </div>
      </div>
    </div>
</div>
<?php } else {
	header ('Location: ?p=404');
	}