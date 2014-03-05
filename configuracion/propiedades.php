<?php
	# Propiedades MYSQL
	$prop_op = mysql_query("SELECT * FROM propiedades WHERE idpropiedades = 1", $conn) or die (mysql_error());
	$prop = mysql_fetch_array($prop_op);
		
	# Define $gtp variable
	$gtp = isset($_GET["$prop[nombre]"]) ? $_GET["$prop[nombre]"] : "";
?>