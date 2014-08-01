<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
if (rango() == 0) { ?>
<div class="well-bl-form">
	<h1>Recuperar contraseña</h1>
    <h5>	Para poder recuperar tu contraseña es necesario que pongas tu correo electrónico para que le podamos enviar un correo para restablecer su contraseña</h5>
    <form method="post">
        <div class="form-group login-email">
            <label for="login-email" class="control-label">Correo electrónico: <small><span id="resultado-email-error"></span></small></label>
            <input class="form-control" type="email" name="email" placeholder="email" id="login-email" required>
        </div>
        <div class="form-group">
            <button class="btn btn-warning form-control login-submit" id="login-submit">Recuperar contraseña</button>
        </div>
    </form>
</div>
<?php } else {
	header ('Location: ?p=404');
	}