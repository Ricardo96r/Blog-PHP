<div class="fondo" id="registro">
<?php
if (!isset($_SESSION["username"])) {
	if (!isset($_POST["registro"])) {
?>
<div id="registro-form">
	<form method="post" action="">
		<label for="registro-form-cuenta-input" id="registro-form-label">
			Nombre de usuario
		</label>
		<input type="text" name="cuenta" id="registro-form-cuenta-input" maxlength="20"  placeholder="nombre de usuario" required>
        
		<label for="registro-form-contraseña1-input" id="registro-form-label">
        	Contraseña
        </label><br>
		<input type="password" name="contraseña" id="registro-form-contraseña1-input" maxlength="30" placeholder="nueva contraseña" required>
       
		<label for="registro-form-contraseña2-input" id="registro-form-label">
        	Repetir contraseña
        </label>
		<input type="password" name="contraseña2" id="registro-form-contraseña2-input" maxlength="30" placeholder="repita contraseña" required>
        
		<label for="registro-form-correo-input" id="registro-form-label">
        	Correo electrónico
		</label>
		<input type="email" name="email" id="registro-form-correo-input" maxlength="100" placeholder="correo electrónico" required>
        
		<label for="registro-form-nombres-input" id="registro-form-label">
        	Nombre(s)
        </label>
		<input type="text" name="nombres" id="registro-form-nombres-input" maxlength="20" placeholder="nombre(s)" required>
        
		<label for="registro-form-apellidos-input" id="registro-form-label">
        	Apellido(s):
        </label>
		<input type="text" name="apellidos" id="registro-form-apellidos-input" maxlength="20" placeholder="apellido(s)"  required>
        <div id="registro-form-nacimiento">
        <div id="registro-form-nacimiento-text">Nacimiento</div>
			<?php
            echo mostrarNacimiento('dia');
            echo mostrarNacimiento('mes');
            echo mostrarNacimiento('año');
            ?>
        </div>
        <div id="registro-form-sexo">             
            <label for="hombre" id="registro-form-label">
                Hombre
            </label>
            <input type="radio" name="sexo" id="hombre" value="1">
            
            <label for="mujer" id="registro-form-label">
                Mujer
            </label>
			<input type="radio" name="sexo" id="mujer" value="2">
        </div>
        
		<input type="submit" name="registro" id="registro-form-submit" value="Registrarse">
	</form>
</div>
<?php
} else {
	$cuenta = antiSqlInjection($_POST['cuenta']);
	$contraseña = antiSqlInjection($_POST['contraseña']);
	$contraseña2 = antiSqlInjection($_POST['contraseña2']);
	$email = antiSqlInjection($_POST['email']);
	$nombres = antiSqlInjection($_POST['nombres']);
	$apellidos = antiSqlInjection($_POST['apellidos']);
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
		echo "El campo nombre(s) tiene que ser menor a 20 caracteres";
		
	//$apellidos
	} elseif(!isset($apellidos) or empty($apellidos)) {
		echo "Porfavor llene el campo apellido(s)";
	} elseif(strlen($apellidos) < 1){
		echo "Porfavor llene el campo apellido(s)";
	} elseif(strlen($apellidos) > 20){
		echo "El campo apellido(s) tiene que ser menor a 20 caracteres";
		
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
			$ia = mysql_query("INSERT INTO `cuentas` (`cuenta`,`contraseña`,`nacimiento`,`email`,`nombres`,`apellidos`,`sexo`) VALUES ('".$cuenta."','".$contraseña."','".$nacimiento."','".$email."','".$nombres."','".$apellidos."','".$sexo."')") or die(mysql_error());
				
			echo "usuario:<br>".$cuenta."<br><br>";
			echo "contraseña:<br>".$contraseña."<br><br>";
			echo "contraseña en sha1:<br>".sha1($contraseña)."<br><br>";
			echo "nacimiento:<br>".$nacimiento."<br><br>";
			echo "email:<br>".$email."<br><br>";
			echo "nombres:<br>".$nombres."<br><br>";
			echo "apellidos:<br>".$apellidos."<br><br>";
			echo "sexo:<br>".$sexo."<br><br>";
			echo "Tu registro a sido exitoso, se le enviará un correo para confirmar su correo electrónico";
			}
		}
} else {
	header("Location: ?p=404");
	}
	
		
?>
</div>