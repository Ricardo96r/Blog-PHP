<?php
if(isset($_SESSION['username'])) {
	session_destroy();
	echo"cerrando sesión";
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
} else {
	echo "Tu no has iniciado sesión";
	header("Location: ".$_SERVER['HTTP_REFERER']);
	}
?>
  <br>
  <br>