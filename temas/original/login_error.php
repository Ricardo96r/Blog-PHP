 <div class="well-bl-1">
	<?php
    if (!isset($_SESSION['username'])) {
    ?>
<div class="row">
	<div class="col-xs-12">
   <form method="post" action="">
   <p>
        <label for="login-form-email" id="login-form-label">
            Email:
        </label>
        <input class="form-control" type="email" name="email2" placeholder="email" id="login-form-email" required>
        
        <label for="login-form-contraseña" id="login-form-label">
            Contraseña:
        </label>
        <input class="form-control" type="password" name="contraseña2" id="login-form-contraseña" placeholder="contraseña" required>
        <div id="login-form-ncsesion">
            <input type="checkbox" name="ncsesion2" id="login-form-ncsesion-input" value="1">
            <label for="login-form-ncsesion-input" id="login-form-label">
                No cerrar sesión
            </label>
        </div>
            <script>
	function login(permiso, email2, contraseña2){
			var parametros = {
					"permiso" : permiso,
					"email2" : email2,
					"contraseña2" : contraseña2,
			};
			$.ajax({
					data:  parametros,
					url:   '<?php echo "temas/".$prop['tema']."/ajax/login.php"; ?>',
					type:  'post',
					beforeSend: function () {
							new Spinner(opts).spin(document.getElementById('resultado'));
					},
					success: function(respuesta) {
						$('#resultado').html((respuesta == 'Conectando...' || respuesta == 'No tienes permiso para entrar aqui!') ? location.reload() : respuesta);
					}
			});
	}
	</script>
        <buttom type="submit" onclick="login(
        'allowed',
        $('#login-form-email').val(),
        $('#login-form-contraseña').val()
        );return false;" class="btn btn-warning form-control">Iniciar sesión</buttom>
        </p>
    </form>
    <div id="resultado"></div>
    <div class="text-center">
        <a href="#">¿Olvidaste tu contraseña?</a>
    </div>
    </div>
</div>
    <?php 
    } else { 
        header("Location: .");
    }
    ?>
	</div>