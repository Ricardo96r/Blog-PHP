<div class="well-bl-form">
<?php
if (!isset($_SESSION['username'])) {
?>
<h1> ¡Regístrate!</h1>
<form method="post">
<div class="form-group registro-form-cuenta-input">
	<label for="registro-form-cuenta-input" class="control-label">Nombre de usuario <small><span id="resultado-cuenta-error"></span></small></label>
	<input class="form-control" type="text" name="cuenta" id="registro-form-cuenta-input" maxlength="15"  placeholder="nombre de usuario" required>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group registro-form-contraseña1-input">
    <label for="registro-form-contraseña1-input" class="control-label">Contraseña <small><span id="resultado-contraseña1-error"></span></small></label>
    <input class="form-control" type="password" name="contraseña" id="registro-form-contraseña1-input" maxlength="30" placeholder="nueva contraseña" required>
</div>
</div>
<div class="col-md-6">
<div class="form-group registro-form-contraseña2-input">
    <label for="registro-form-contraseña2-input" class="control-label">Repetir contraseña <small><span id="resultado-contraseña2-error"></span></small></label>
    <input class="form-control" type="password" name="contraseña2" id="registro-form-contraseña2-input" maxlength="30" placeholder="repita contraseña" required>
</div>
</div>
</div> 
<div class="form-group registro-form-correo-input">
    <label for="registro-form-correo-input" class="control-label">Correo electrónico <small><span id="resultado-correo-error"></span></small></label>
    <input class="form-control" type="email" name="email" id="registro-form-correo-input" maxlength="100" placeholder="correo electrónico" required>
</div>
<div class="form-group registro-form-nombres-input">
    <label for="registro-form-nombres-input" class="control-label">Nombre y apellido <small><span id="resultado-nombres-error"></span></small></label>
    <input class="form-control" type="text" name="nombres" id="registro-form-nombres-input" maxlength="20" placeholder="nombre y apellido" required>
</div>
<div class="form-group registro-form-nacimiento-input">
<label class="control-label text-center">Nacimiento: <small><span id="resultado-nacimiento-error"></span></small></label>
<div class="row">
    <div class="col-xs-4">
        <?php echo mostrarNacimiento('dia'); ?>
    </div>
    <div class="col-xs-4">
        <?php echo mostrarNacimiento('mes'); ?>
    </div>
    <div class="col-xs-4">
        <?php echo mostrarNacimiento('año'); ?>
    </div>
</div>
</div>
<div class="form-group registro-form-sexo-input">
	<label class="control-label">Género: <small><span id="resultado-sexo-error"></span></small></label>
    <select class="form-control" id="registro-form-sexo-input">
        <option value=0>Género</option>
        <option value=1>Hombre</option>
        <option value=2>Mujer</option>	
    </select>
</div>
<div class="form-group">
	<button class="btn btn-warning form-control registro-submit" id="registro-submit">Registrarse</button>
</div>
</form>
<div id="resultado"></div>
<script src="<?php echo 'temas/'.$prop['tema'];?>/ajax/registro.js"></script>
</div>
<?php
} else {
	header('Location: .');
	}