<div class="well-bl-form">
	<?php if (!isset($_SESSION['username'])) {?>
    <h1>
    	Iniciar sesión
    </h1>
    <form method="post">
        <div class="form-group login-email">
            <label for="login-email" class="control-label">Email: <small><span id="resultado-email-error"></span></small></label>
            <input class="form-control" type="email" name="email" placeholder="email" id="login-email" required>
        </div>
        <div class="form-group login-contraseña">
            <label for="login-contraseña" class="control-label">Contraseña: <small><span id="resultado-contraseña-error"></span></small></label>
            <input class="form-control" type="password" name="contraseña" id="login-contraseña" placeholder="contraseña" required>
        </div>
        <div class="form-group login-ncsesion">
            <input type="checkbox" name="ncsesion" id="login-ncsesion" value="1">
            <label for="login-ncsesion" class="control-label">
                No cerrar sesión
            </label>
        </div>
        <div class="form-group">
            <button class="btn btn-warning form-control login-submit" id="login-submit">Inicar Sesión</button>
        </div>
    </form>
    <div id="resultado"></div>
    <div class="text-center">
        <a href="#">¿Olvidaste tu contraseña?</a>
    </div>
    <?php } else {
        header('Location: ?#ref=login');
    }
    ?>
</div>