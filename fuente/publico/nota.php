<?php
	if(isset($_GET['nota'])){
		$main = $_GET['nota'];
	}else{
		$main = "";
	}
	
	if($gtp == "principal"){
		if($main == ""){
			include 'principal-contenido.php';		   
		} elseif($main == "registro"){
			include('fuente/publico/registro.php');
		} elseif($main == "login"){
			include('fuente/publico/login_error.php');
		} elseif($main == "enviar_nota"){
			include('fuente/publico/anotalo.php');
		} elseif($main == "nota"){
			include('fuente/publico/nota.php');
		}else{
			header("Location: ?".$prop['nombre']."=principal");
		}
	}else{
		header("Location: ?".$prop['nombre']."=principal");
	}
	?>