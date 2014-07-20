<?php
/*
	NO-USER == 0
	USER == 1
	ADMIN == 2
*/

function rango() {
	global $db;
	
	if(isset($_SESSION['username'])) {
		$cuenta = $_SESSION['username'];
	} else {
		$cuenta = NULL;
		}
		
	if(isset($cuenta)) {
		$rquery_o = $db->query("SELECT rango FROM cuentas WHERE email = '".$cuenta."'");
		$rquery = $rquery_o->fetch_array();
		switch ($rquery['rango']) {
			case 0: // USER
				$rango = 1;
				break;
			case 1: // ADMIN
				$rango = 2;
				break;
			}
	} else {
		$rango = 0;
		}
		
	echo $rango;
}