<?php
$counts = mysql_query("SELECT * FROM notas") or die (mysql_error());
$count = (mysql_num_rows($counts) / 10);

if (isset($_GET['pos']) and is_numeric($_GET['pos']) and $_GET['pos'] >= 0 and $_GET['pos'] <= $count) {
  $inicio=$_GET['pos'];
} else {
  $inicio=0;
}

$inicio_2 = $inicio*10;
$registros=mysql_query("SELECT idCuentas, cuenta, nota, notas.tiempo_de_creacion  FROM cuentas
						INNER JOIN notas 
						ON cuentas.idcuentas = notas.cuentas_idcuentas
						ORDER BY `idnotas` DESC
						LIMIT $inicio_2,10", $conn) or die(mysql_error());
$impresos=0;

while ($reg=mysql_fetch_array($registros)) {
	?>
	<div id="contenido">
	<?php
  	$impresos++;
	if (isset($_SESSION['username'])) {
		echo "Nombre:".$reg['cuenta']."-------";
		echo "Fecha:".$reg['tiempo_de_creacion']."<br>";
		echo "<strong>".$reg['nota']."</strong><br>";
		echo "\\ a favoritos \\";
		echo "\\ me gusta \\";
		echo "\\ comentar \\.";
		echo $count;
	} else {	  
		echo "Nombre:".$reg['cuenta']."-------";
		echo "Fecha:".$reg['tiempo_de_creacion']."<br>";
		echo "<strong>".$reg['nota']."</strong><br>";
	}
 	 ?>
    </div>
    <br>
  	<?php
}

$impresos /= 10;

if ($inicio==0) {
	echo "";
} else {
	$anterior=$inicio-1;
	echo "<a href=\"?".$prop['nombre']."=principal&pos=$anterior\"><<<--Anteriores </a>";
}

if ($impresos==1) {
	$proximo=$inicio+1;
	echo "<a href=\"?".$prop['nombre']."=principal&pos=$proximo\">Siguientes-->>></a>";
} else {
	echo "";
}
?>