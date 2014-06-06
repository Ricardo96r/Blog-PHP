<?php if (isset($_SESSION['username'])) {?>
<div class="well-bl-1">
<h2>Configuración:</h2>
	<h4>Editar imagen de perfil:</h4>
    <div class="img-responsive center-block" style="max-width:260px; min-width: 40px;">
        <a href="#" class="thumbnail">
          <img src="static-content/perfiles/<?php echo $pf['imagen_perfil']?>">
        </a>
    </div>
    <button class="btn btn-warning form-control" data-toggle="modal" data-target="#editar_perfil">Editar foto de perfil</button>
    <!-- Modal -->
    <div class="modal fade" id="editar_perfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Editar foto de perfil<small> Solo imagenes cuadradas!</small></h4>
          </div>
          <div class="modal-body">
          <script>
			function perfil_imagen(permiso, pf_imagen) {
					var parametros = {
							"permiso" : permiso,
							"pf_imagen" : pf_imagen,
					};
					$.ajax({
							data:  parametros,
							url:   '?p=ajax&action=pefil_imagen',
							type:  'post',
							beforeSend: function () {
									$("#resultado").html("Enviando...");
							},
							success:  function (response) {
									$("#resultado").html(response);
							}
					});
			}
			</script>
            <form enctype="multipart/form-data" method="post" action="">
                <div id="publicar-form-file">
                <input name="img_pf" type="file" class="perfil_imagen_cambiar" id="publicar-form-file-input">
                    <div class="img-responsive" id="publicar-form-file-text">
                    	<button type="button" class="btn btn-warning btn-lg">
                            <span class="glyphicon glyphicon-camera"></span>
                            <div>Subir imagen de perfil</div>
						</button>
                    </div>
                </div>
                <script src="<?php echo "temas/".$prop['tema'];?>/js/publicar.js"></script>
			</form>
            <div id="resultado"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary"
            onclick="perfil_imagen(
                'allowed',
                $('.perfil_imagen_cambiar').val()
                );return false;"
            >Save changes</button>
          </div>
        </div>
      </div>
    </div>
    </div>
<?php } else {
	header ("Location: ?p=404");
	}