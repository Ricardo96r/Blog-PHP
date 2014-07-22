<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
function publicidad () {
	global $prop;?>
	<img class="center-block" src="temas/<?php echo $prop['tema'];?>/imagenes/publicidad.png" >
	<?php }