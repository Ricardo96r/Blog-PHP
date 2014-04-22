<?php /*
	Configuracion css para que solo el usuario descargue lo esencial y no descargue todas las hojas de estilo no necesarias
*/?>

    <link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/css-reset.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/header.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/nav.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/estilos.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/aside.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/footer.css">

<?php 
switch ($page) {
	case "":
		if(isset($_SESSION['username'])) {
			echo "";
		} else { // INTRO
			?><link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/intro.css"><?php
			}
	break;
	case "publicar":
		?><link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/publicar.css"><?php
	 break;
	case "registro":
		?><link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/registro.css"><?php 
	break;
	case "explorar": 
		?><?php
	break;
	case "login": 
		?><link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/login.css"><?php
	break;
	case "perfil": 
		?><link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/perfil.css"><?php
	break;
	case "404": 
		?><link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/404.css"><?php
	break;	
}
?>