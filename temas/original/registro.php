<div class="well-bl-1">
<?php
if (!isset($_SESSION['username'])) {
?>
<form method="post">
<div class="row">
    <div class="col-xs-12">
        <label for="registro-form-cuenta-input" id="registro-form-label">Nombre de usuario</label>
        <p><input class="form-control" type="text" name="cuenta" id="registro-form-cuenta-input" maxlength="15"  placeholder="nombre de usuario" required></p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
    <label for="registro-form-contraseña1-input" id="registro-form-label">Contraseña</label>
    <p><input class="form-control" type="password" name="contraseña" id="registro-form-contraseña1-input" maxlength="30" placeholder="nueva contraseña" required></p>
    </div>
    <div class="col-md-6">
    <label for="registro-form-contraseña2-input" id="registro-form-label">Repetir contraseña</label>
    <p><input class="form-control" type="password" name="contraseña2" id="registro-form-contraseña2-input" maxlength="30" placeholder="repita contraseña" required></p>
    </div> 
</div>
<div class="row">
    <div class="col-xs-12"> 
    <label for="registro-form-correo-input" id="registro-form-label">Correo electrónico</label>
    <p><input class="form-control" type="email" name="email" id="registro-form-correo-input" maxlength="100" placeholder="correo electrónico" required></p>
    </div> 
</div>
<div class="row">
    <div class="col-md-12"> 
    <label for="registro-form-nombres-input" id="registro-form-label">Nombre y apellido</label>
    <p><input class="form-control" type="text" name="nombres" id="registro-form-nombres-input" maxlength="20" placeholder="nombre y apellido" required></p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
    	<label class="text-center">Nacimiento:</label>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php echo mostrarNacimiento('dia'); ?>
    </div>
    <div class="col-md-4">
        <?php echo mostrarNacimiento('mes'); ?>
    </div>
    <div class="col-md-4">
        <?php echo mostrarNacimiento('año'); ?>
    </div>
</div>
<p>
<div class="row">
	<div class="col-md-12">
    	<label>Género:</label>
    	<select name="mes" class="form-control" id="registro-form-sexo-input">
       		<option value=0>Género</option>
        	<option value=1>Hombre</option>
            <option value=2>Mujer</option>	
        </select>
    </div>
</div>
</p>
<div class="row">
	<div class="col-xs-12">
		<button class="btn btn-warning form-control registro-submit" id="registro-submit">Registrarse</button>
	</div>
</div>
</form>
<div id="resultado"></div>
<script src="<?php echo 'temas/'.$prop['tema'];?>/ajax/registro.js"></script>
</div>
<?php
} else {
	header('Location: .');
	}