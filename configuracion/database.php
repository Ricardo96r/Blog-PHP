<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
$db = new mysqli('localhost', 'root', '2318860212', 'proyecto');

if ($db->connect_errno) {
    echo 'Falló la conexión con MySQL: (' . $db->connect_errno . ') ' . $db->connect_error;
}