<?php
	if(isset($_GET['page'])){
		$main = $_GET['page'];
	}else{
		$main = "";
	}
	
	if($gtp == "principal"){
		if($main == ""){
			if (isset($_SESSION['username'])) {
				include 'principal-contenido.php';
			} else {
				include 'intro.php';
				}
		} elseif($main == "registro"){
			include('fuente/publico/registro.php');
		} elseif($main == "login"){
			include('fuente/publico/login_error.php');
		}else{
			header("Location: ?".$prop['nombre']."=principal");
		}
	}else{
		header("Location: ?".$prop['nombre']."=principal");
	}
	?>