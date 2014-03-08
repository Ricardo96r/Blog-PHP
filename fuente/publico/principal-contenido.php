<?php
$counts = mysql_query("SELECT * FROM notas") or die (mysql_error());
$count = (mysql_num_rows($counts));

if (isset($_GET['pos']) and is_numeric($_GET['pos']) and $_GET['pos'] >= 0 and $_GET['pos'] <= ($count / 10)) {
  $inicio=$_GET['pos'];
} else {
  $inicio=0;
}

if (isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 0 and $_GET['id'] <= $count) {
	$com=$_GET['id'];
	$registro_com=mysql_query("
	SELECT cuentas.cuenta, comentarios.cuentas_idcuentas, comentarios.notas_idnotas, comentarios.comentario, notas.idnotas, comentarios.idcomentarios
	FROM comentarios 
	INNER JOIN notas
	ON notas.idnotas = comentarios.notas_idnotas
	INNER JOIN cuentas
	ON cuentas.idcuentas = comentarios.cuentas_idcuentas
	WHERE notas.idnotas=$com
	", $conn) or die(mysql_error());
} else {
	#REVISAR EN EL FUTURO
	/* Esta accion se encuentra mas abajo
	header("Location: ?$prop[nombre]=principal&pos=$inicio");
	*/
}
						
$inicio_2 = $inicio*10;
$registros=mysql_query("
	SELECT cuentas.idCuentas, cuentas.cuenta,cuentas.nombres, cuentas.apellidos, notas.idnotas, notas.nota, notas.tiempo_de_creacion  
	FROM cuentas
	INNER JOIN notas 
	ON cuentas.idcuentas = notas.cuentas_idcuentas
	ORDER BY `idnotas` DESC
	LIMIT $inicio_2,10", $conn) or die(mysql_error());
$impresos=0;

if (!isset($_GET['id'])) {
	while ($reg=mysql_fetch_array($registros)) {
		?><div id="contenido"><?php
			$impresos++;
			if (isset($_SESSION['username'])) {
				echo $reg['nombres']." ".$reg['apellidos']." @".$reg['cuenta'];
				echo "Fecha:".$reg['tiempo_de_creacion']."<br>";
				echo "<a href='/proyecto/Proyecto/?proyecto=principal&pos=$inicio&id=$reg[idnotas]'>";
				echo "<strong>".$reg['nota']."</strong><br>";
				echo "</a>";
			} else {	  
				echo $reg['nombres']." ".$reg['apellidos']." @".$reg['cuenta'];
				echo $reg['tiempo_de_creacion']."<br>";
				echo "<a href='/proyecto/Proyecto/?proyecto=principal&pos=$inicio&id=$reg[idnotas]'>";
				echo "<strong>".$reg['nota']."</strong><br>";
				echo "</a>";
			}
		?></div><br><?php
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

} else {
	if(isset($com)) {
		$reg=mysql_fetch_array($registros);
		?><div id="contenido"><?php
				echo "Nombre:".$reg['cuenta']."-------";
				echo "Fecha:".$reg['tiempo_de_creacion']."<br>";
				echo "<strong>".$reg['nota']."</strong><br></a>";
		?></div><?php
		echo "<strong><h3>Comentarios:</h3></strong>";
		if (mysql_num_rows($registro_com) > 0) {
			while ($cm=mysql_fetch_array($registro_com)) {
				?><div id="contenido"><?php
					if (isset($_SESSION['username'])) {
						echo "Nombre:".$cm['cuenta']."-------";
						echo "<strong>".$cm['comentario']."</strong><br>";
						echo "\\ a favoritos \\";
						echo "\\ me gusta \\";
						echo "\\ comentar \\.";
					} else {	  
						echo "Nombre:".$cm['cuenta']."-------";
						echo "<strong>".$cm['comentario']."</strong><br></a>";
					}
				?></div><br><?php
			}
		} else {
			?><div style="text-align:center" id="contenido">
            <strong>No hay comentarios</strong><br>
            </div>
			<?php }
		?><div id="contenido"><?php
		if(isset($_SESSION['username'])) {
			if(!isset($_POST['enviar_nota'])) {
			?>Escribe una nota:<br>
            <form method="post" action="">
                <input type="text" name="comentario" maxlength="400" required>
                <input type="submit" name="enviar_nota" value="enviar nota">
            </form><?php
            } else {
                $idcuentap = mysql_query("SELECT idcuentas, email FROM cuentas WHERE email = '$_SESSION[username]'");
                $idcuentap2 = mysql_fetch_array($idcuentap);
                $idcuenta = $idcuentap2['idcuentas'];
                $comentario = antiSqlInjection($_POST['comentario']);
                if(!isset($comentario) and empty($comentario)) {
                    echo "Porfavor no deje campos vacios";
                } elseif(strlen($comentario) < 20) {
                    echo "La nota es muy corta, tiene que tener mas de 20 caracteres";
                } elseif(strlen($comentario) > 400){
                    echo "La nota es muy larga, el máximo de caracteres es 400";
                } else {
                $enviar_nota = mysql_query("
					INSERT INTO `comentarios` (`cuentas_idcuentas`, `notas_idnotas`, `comentario`) 
					VALUES ('".$idcuenta."','".$com."','".$comentario."')") or die (mysql_error());
                echo "nota enviada";
                    }
                }
		} else {
		echo "Para escribir un comentario nesecitas iniciar sesión";
		?></div><br><?php
		}
	} else {
		header("Location: ?$prop[nombre]=principal&pos=$inicio");
		}
	}
?>