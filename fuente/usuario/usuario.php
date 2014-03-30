<?php
	if(isset($_GET['page'])){
		$main = $_GET['page'];
	}else{
		$main = "";
	}
	
	if($gtp == "usuario"){
		if($main == ""){
			header("Location: ?".$prop['nombre']."=principal");   
		} elseif($main == "cerrar_sesión"){
			include('fuente/usuario/cerrar_sesion.php');
		} elseif($main == "opciones"){
			include('fuente/usuario/opciones.php');
		} elseif($main == "perfil"){
			include('fuente/usuario/perfil.php');
		} elseif($main == "enviar_publicacion"){
			include('fuente/usuario/enviar_publicacion.php');
		}else{
			header("Location: ?".$prop['nombre']."=principal");
		}
	}else{
		header("Location: ?".$prop['nombre']."=principal");
		} 

	?>