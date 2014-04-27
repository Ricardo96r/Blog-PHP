<?php

	/*
		Load: HEADER
	*/
	include("temas/".$prop['tema']."/header.php");
	
	/*
		NAV
	*/
	include("temas/".$prop['tema']."/nav.php");
	
	/*
		Load: SECTION
	*/
	if($page == ""){
		if (isset($_SESSION['username'])) {
			include 'principal-contenido.php';
		} else {
			include 'intro.php';
			}
	} elseif($page == "registro"){
		include('registro.php');
	} elseif($page == "login"){
		include('login_error.php');
	} elseif($page == "cerrar_sesión"){
		include('cerrar_sesion.php');
	} elseif($page == "opciones"){
		include('opciones.php');
	} elseif($page == "perfil"){
		include('perfil.php');
	} elseif($page == "publicar"){
		include('publicar.php');
	} elseif($page == "explorar"){
		include('explorar.php');
	} elseif($page == "404"){
		include('404.php');
	}else{
		header("Location: ?p=404");
	}
	
	/*
		Load: FOOTER
	*/
	if(!isset($_SESSION['username'])) {
		if($page != "") {
		include("temas/".$prop['tema']."/pie.php");
			} else {
				echo "";
				}
	} else {
		include("temas/".$prop['tema']."/pie.php");
		}
	
	/*
		Load: ASIDE
	*/
	if(!isset($_SESSION['username'])) {
		if($page != "") {
		include("temas/".$prop['tema']."/aside.php");
			} else {
				echo "";
				}
	} else {
		include("temas/".$prop['tema']."/aside.php");
		}
?>