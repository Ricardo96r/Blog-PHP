<div class="well-bl-1">
<?php
if (!isset($_SESSION["username"])) {
	if (!isset($_POST["registro"])) {
?>
<form method="post" action="">
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
	<div class="col-md-12 text-center">     
        <label for="hombre" id="registro-form-label">
            Hombre
        </label>
        <input type="radio" name="sexo" id="hombre" value="1">
        <label for="mujer" id="registro-form-label">
            Mujer
        </label>
        <input type="radio" name="sexo" id="mujer" value="2">
    </div>
</div>
</p>
<div class="row">
	<div class="col-xs-12">
    	<input type="submit" name="registro" class="btn btn-warning form-control" value="Registrarse">
	</div>
</div>
</form>
</div>
<?php
} else {
	$cuenta = antiSqlInjection($_POST['cuenta']);
	$contraseña = antiSqlInjection($_POST['contraseña']);
	$contraseña2 = antiSqlInjection($_POST['contraseña2']);
	$email = antiSqlInjection($_POST['email']);
	$nombres = antiSqlInjection($_POST['nombres']);
	$nacimiento = antiSqlInjection($_POST['año'])."-".antiSqlInjection($_POST['mes'])."-".antiSqlInjection($_POST['dia']); 
	
	if(isset($_POST['sexo'])) {
		$sexo = antiSqlInjection($_POST['sexo']);
	} else {
		$sexo = 3;
		}

	$crevisar = mysql_query("SELECT cuenta FROM `cuentas` WHERE `cuenta`='".$cuenta."'") or die(mysql_error());
	$erevisar = mysql_query("SELECT email FROM `cuentas` WHERE `email`='".$email."'") or die(mysql_error());
	/*
	-----------------------
	Errores al registrarse
	-----------------------
	*/
	//$cuenta
	 if(!isset($cuenta) or empty($cuenta)) {
		echo "Porfavor llene el nombre de usuario";
	} elseif(strlen($cuenta) < 4) {
		echo "El nombre de usuario tiene que tener mas de 4 caracteres!";
	} elseif(strlen($cuenta) > 20){
		echo "El nombre de usuario tiene que tener entre 4 a 20 caracteres!";
	} elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $cuenta)){
		die('<h3>Error en el nombre de usuario</h3>
			 <strong>Solo se aceptan caracteres alfanuméricos:</strong><br>
			 A-Z mayusculas y minusculas. Exeptuando la Ñ<br> 
			 Numeros: 0-9<br>
			 Signos: _ <br><br>
			 <strong>No es valido: </strong><br>
			 El espacio, todo tiene que ir pegado');
	} elseif (mysql_num_rows($crevisar) != NULL) {
		echo "Este nombre de usuario ya esta en uso";
		
	//$contraseña
	} elseif(!isset($contraseña) or empty($contraseña)) {
		echo "Porfavor llene la contraseña";
	} elseif(strlen($contraseña) < 6){
		echo "La contraseña tiene que ser mayor de 6 caracteres";
	} elseif(strlen($contraseña) > 30){
		echo "La contraseña tiene que ser menor a 30 caracteres";
	} elseif(!isset($contraseña2) or empty($contraseña2)) {
		echo "Porfavor llene la verificacion de contraseña";
	} elseif($contraseña !== $contraseña2) {
		echo "Los campos de contraseña y repetir contraseña no son iguales";
		
	//$email
	} elseif(!isset($email) or empty($email)) {
		echo "Porfavor llene el campo email";
	} elseif(strlen($email) < 1){
		echo "Porfavor llene el campo email";
	} elseif(strlen($email) > 100){
		echo "El email es muy largo";
	} elseif (mysql_num_rows($erevisar) != NULL) {
		echo "Este email ya esta en uso";
		
	//$nombres
	} elseif(!isset($nombres) or empty($nombres)) {
		echo "Porfavor llene el campo nombres";
	} elseif(strlen($nombres) < 1){
		echo "Porfavor llene el campo nombres";
	} elseif(strlen($nombres) > 20){
		echo "El campo nombre(s) tiene que ser menor o igual a 20 caracteres";
		
	//$nacimiento
	}elseif(!isset($nacimiento) or empty($nacimiento)){
		echo "Porfavor ponga la fecha de nacimiento!";  
	} elseif($_POST['año'] == "año" or 
			$_POST['mes'] == "mes" or
			$_POST['dia'] == "dia"){
		echo "Porfavor ponga la fecha de nacimiento!"; 
	} elseif (!checkdate($_POST['mes'], $_POST['dia'], $_POST['año'])) {
		echo "Fecha de nacimiento invalidad. Esta fecha no existe";
		
	//$sexo
	} elseif (!isset($sexo) or empty($sexo) or $sexo == 3) { //REVISAR ERROR
		echo "Porfavor llene el campo sexo";
		
	/*
	----------------
	Envio de datos
	----------------
	*/
		} else {
			$ia = mysql_query("INSERT INTO `cuentas` (`cuenta`,`contraseña`,`nacimiento`,`email`,`nombres`,`sexo`) VALUES ('".$cuenta."','".$contraseña."','".$nacimiento."','".$email."','".$nombres."','".$sexo."')") or die(mysql_error());
				
			echo "usuario:<br>".$cuenta."<br><br>";
			echo "contraseña:<br>".$contraseña."<br><br>";
			echo "contraseña en sha1:<br>".sha1($contraseña)."<br><br>";
			echo "nacimiento:<br>".$nacimiento."<br><br>";
			echo "email:<br>".$email."<br><br>";
			echo "nombres:<br>".$nombres."<br><br>";
			echo "sexo:<br>".$sexo."<br><br>";
			echo "Tu registro a sido exitoso, se le enviará un correo para confirmar su correo electrónico";
			}
		}
} else {
	header("Location: ?p=404");
	}
	
		
?>