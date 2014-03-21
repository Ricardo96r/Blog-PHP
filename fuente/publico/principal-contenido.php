<?php
$counts = mysql_query("SELECT idpublicacion FROM publicaciones") or die (mysql_error());
$count = (mysql_num_rows($counts));

if (isset($_GET['pos']) and is_numeric($_GET['pos']) and $_GET['pos'] >= 0 and $_GET['pos'] <= (($count / 10))) {
  $inicio=$_GET['pos'];
} else {
  $inicio=0;
}

if (isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 0 and $_GET['id'] <= $count) {
	$com=$_GET['id'];
	$registro_com=mysql_query("
	SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombres, cuentas.apellidos, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, comentarios.cuentas_idcuenta, comentarios.publicaciones_idpublicacion, comentarios.comentario, comentarios.tiempo_de_creacion, comentarios.idcomentario,publicaciones.idpublicacion
	FROM comentarios 
	INNER JOIN publicaciones
	ON publicaciones.idpublicacion = comentarios.publicaciones_idpublicacion
	INNER JOIN cuentas
	ON cuentas.idcuenta = comentarios.cuentas_idcuenta
	WHERE publicaciones.idpublicacion=$com
	", $conn) or die(mysql_error());
} else {
	#REVISAR EN EL FUTURO
	/* Esta accion se encuentra mas abajo
	header("Location: ?$prop[nombre]=principal&pos=$inicio");
	*/
}
						
/* 
	PUBLICACIONES 
*/
if (!isset($_GET['id'])) {
	$inicio_2 = $inicio*10;
	$registros=mysql_query("
		SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombres, cuentas.apellidos, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion  
		FROM cuentas
		INNER JOIN publicaciones 
		ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
		ORDER BY `idpublicacion` DESC
		LIMIT $inicio_2,10", $conn) or die(mysql_error());
	while ($reg=mysql_fetch_array($registros)) {
		post($reg);
	}
	$proximo=$inicio+1;
	$anterior=$inicio-1;
	
	if ($inicio == 0) { ?>
    	<div id="publicaciones-principal-final">
            <a href="?<?php echo $prop['nombre'];?>=principal&pos=<?php echo $proximo; ?>">
                <button id="publicaciones-principal-boton_siguiente">
                    Siguiente -->
                </button>
            </a> 
		</div><?php 
	} elseif ($inicio < ($count / 10)) {?>
    <div id="publicaciones-principal-final">
    	<a href="?<?php echo $prop['nombre'];?>=principal&pos=<?php echo $anterior; ?>">
			<button id="publicaciones-principal-boton_anterior">
				<-- Anterior
			</button>
        </a>
		<a href="?<?php echo $prop['nombre'];?>=principal&pos=<?php echo $proximo; ?>">
			<button id="publicaciones-principal-boton_siguiente">
				Siguiente -->
			</button>
		</a> 
    </div>
	<?php		
	} else { ?>
    <div id="publicaciones-principal-final">
        <a href="?<?php echo $prop['nombre'];?>=principal&pos=<?php echo $anterior; ?>">
            	<button id="publicaciones-principal-boton_anterior">
                	<-- Anterior
                </button>
        </a>  
	</div> <?php
		}
		
/* 
	COMENTARIOS
*/
} else {
	if(isset($com)) {
		$registros=mysql_query("
			SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombres, cuentas.apellidos, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion  
			FROM cuentas
			INNER JOIN publicaciones 
			ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
			WHERE idpublicacion = '$com'", $conn) or die(mysql_error());
		$reg=mysql_fetch_array($registros);
		post($reg);?>
		<div id="comentarios">
        	Comentarios
       	</div>
		<?php
		if(isset($_SESSION['username'])) {
			if(!isset($_POST['enviar_nota'])) {
				?>
                <div id="comentario_enviar">
                    <div id="comentario_enviar-comentario">
                        Escribe un comentario:
                    </div>
                    <form method="post" action="">
                        <textarea type="text" name="comentario" maxlength="400" id="comentario_enviar-text" required></textarea>
                        <input type="submit" name="enviar_nota" value="Enviar comentario" id="comentario_enviar-boton">
                    </form>
				</div><?php
            } else {
                $idcuentap = mysql_query("SELECT idcuenta, email FROM cuentas WHERE email = '$_SESSION[username]'");
                $idcuentap2 = mysql_fetch_array($idcuentap);
                $idcuenta = $idcuentap2['idcuenta'];
                $comentario = antiSqlInjection($_POST['comentario']);
                if(!isset($comentario) and empty($comentario)) {
                    echo "Porfavor no deje campos vacios";
                } elseif(strlen($comentario) < 20) {
                    echo "La nota es muy corta, tiene que tener mas de 20 caracteres";
                } elseif(strlen($comentario) > 400){
                    echo "La nota es muy larga, el máximo de caracteres es 400";
                } else {
                $enviar_nota = mysql_query("
					INSERT INTO `comentarios` (`cuentas_idcuenta`, `publicaciones_idpublicacion`, `comentario`) 
					VALUES ('".$idcuenta."','".$com."','".$comentario."')") or die (mysql_error());
                echo "Comentario enviado";
                    }
                }
		} else { ?>
        <div id="comentario_iniciar-sesion">
			<?php echo "Para escribir un comentario nesecitas tener una cuenta e iniciar sesión"; ?>
        </div><?php
		}
		if (mysql_num_rows($registro_com) > 0) {
			while ($cm=mysql_fetch_array($registro_com)) {
				post($cm);
			}
		} else {
			?><div id="comentario_sin-comentarios">
            	No hay comentarios
            </div>
		<?php }
	} else {
		header("Location: ?$prop[nombre]=principal&pos=$inicio");
		}
	}
	include($prop['tema']."/pie.php");
?>