<div id="cont">
<?php
if(isset($_SESSION['username'])) {
echo "MANTENIMIENTO";
} else {
	echo "Tu no has iniciado sesión";
	
	}
?>
</div>