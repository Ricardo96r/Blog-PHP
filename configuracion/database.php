<?php

$host = "localhost:3307";
$user = "root";
$pw = "2318860212";
$db = "proyecto";

$conn = mysql_connect($host, $user, $pw) 
	or die (mysql_error());

mysql_select_db($db, $conn) 
	or die (mysql_error());

?>