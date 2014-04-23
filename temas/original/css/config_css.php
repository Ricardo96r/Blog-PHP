<?php 
/*
	Load: CSS
*/
?>

<link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/css-reset.css">
<link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/header.css">
<link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/nav.css">

<?php 
if(!isset($_SESSION['username'])) {
	if($page != "") {
		?><link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/estilos.css"><?php
		} else  {
			?><link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/estilos-intro.css"><?php
			}
	} else {
		?><link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/estilos.css"><?php
		}
?>

<link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/publicaciones.css">

<?php
if(!isset($_SESSION['username'])) {
    if($page != "") {
        ?><link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/aside.css"><?php
        } else {
            echo "";
            }
} else {
    ?><link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/aside.css"><?php
    }
?>

<?php 
switch ($page) {
	case "":
		if(isset($_SESSION['username'])) {
			echo "";
		} else { // INTRO
			?><link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/index-intro.css"><?php
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

<link rel="stylesheet" type="text/css"  href="<?php echo "temas/".$prop['tema'];?>/css/footer.css">