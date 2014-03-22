<?php
	if(isset($_GET['page'])){
		$main = $_GET['page'];
	}else{
		$main = "";
	}
	
	if($gtp == "user"){
		if($main == ""){
			include 'principal-contenido.php';		   
		} elseif($main == "cerrar_sesión"){
			include('fuente/usuario/cerrar_sesion.php');
		} elseif($main == "opciones"){
			include('fuente/usuario/opciones.php');
		} elseif($main == "perfil"){
			include('fuente/usuario/perfil.php');
		} elseif($main == "enviar_nota"){
			include('fuente/usuario/anotalo.php');
		}else{
			header("Location: ?".$prop['nombre']."=principal");
		}
	}else{
		header("Location: ?".$prop['nombre']."=principal");
	}
	?>