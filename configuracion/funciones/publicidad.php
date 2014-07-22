<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
function publicidad () {
	global $prop;?>
	<img class="center-block" src="static-content/publicidad.png" >
	<?php }