
<?php

if (isset($_GET['pf'])) {
	$perfil_get = antiSqlInjection($_GET['pf']);
  	$perfil_op = mysql_query("
		SELECT idcuenta, cuenta, email, nombres, apellidos, nacimiento, sexo, imagen_perfil, imagen_perfil_fondo
		FROM cuentas WHERE cuenta = '$perfil_get'"
		, $conn) or die (mysql_error());
	$perfil = mysql_fetch_array($perfil_op);
	
	/*
		Necesario para el LIMITE de PUBLICACIONES, atraves de MOSTRAR MAS
	*/
	if (isset($_GET['pid']) and isset($_GET['pf']) and is_numeric($_GET['pid']) and $_GET['pid'] >= 0) {
		$pfinicio = $_GET['pid'];
		$pfcounts = mysql_query("
		SELECT publicaciones.idpublicacion, publicaciones.cuentas_idcuenta, cuentas.idcuenta
		FROM publicaciones 
		INNER JOIN cuentas
		ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
		WHERE cuentas.cuenta = '$perfil_get'") or die (mysql_error());
		$pfcount = (mysql_num_rows($pfcounts));
	} else {
		$pfinicio = 0;
		}
} else {
	header("Location: ?p=404");
}

if (!isset($perfil) or !isset($perfil_get) or empty($perfil) or empty($perfil_get)) {
	header("Location: ?p=404");
	} else {
		if($perfil == !NULL) { 
		$pfinicio_2 = $pfinicio*10;
		$perfil_notas = mysql_query("
			SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombres, cuentas.apellidos, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion 
			FROM publicaciones
			INNER JOIN cuentas
			ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
			WHERE cuentas.cuenta = '$perfil[cuenta]'
			ORDER BY `idpublicacion` DESC
			LIMIT $pfinicio_2,10", $conn) or die(mysql_error());?>
            
	<div class="fondo" id="perfil-contenedor">
        <div id="perfil-fondo-imagen_perfil">
            <img src="static-content/perfiles/<?php echo $perfil['imagen_perfil']?>">
        </div>
        <div id="perfil-fondo-contenido_fondo">
            <div id="perfil-fondo-contenido">
                <div id="perfil-fondo-contenido-nombre">
                    <span>
                    <?php echo $perfil['nombres']." ".$perfil['apellidos'];?>
                    </span>
                </div>
                <div id="perfil-fondo-contenido-cuenta">
                    <span>
                    <?php echo "@".$perfil['cuenta']; ?>
                    </span>
                </div>
			</div>
    	</div>
    <div class="fondo" id="perfil-fondo-contenido-datos" >
        <div id="perfil-fondo-contenido-datos_seguidores">
            <button id="perfil-fondo-contenido-datos_seguidores_boton">
                <div>Seguidores</div>
                <div><?php echo mysql_num_rows($perfil_notas);?></div>
            </button>
        </div>
        <div id="perfil-fondo-contenido-datos_siguiendo">
            <button id="perfil-fondo-contenido-datos_siguiendo_boton">
                <div>Siguiendo</div>
                <div><?php echo mysql_num_rows($perfil_notas);?></div>
            </button>
        </div>
        <div id="perfil-fondo-contenido-datos_publicaciones">
            <button id="perfil-fondo-contenido-datos_publicaciones_boton">
                <div>Publicaciones</div>
                <div><?php echo mysql_num_rows($perfil_notas);?></div>
            </button>
        </div>
    </div>
    </div>
    <div id="perfil-publicaciones">
		<?php			
		while ($nts = mysql_fetch_array($perfil_notas)) {
			post($nts);
			}
		} else {
			header("Location: ?p=404");
			}
		}
		?>
	<?php 
	$pfproximo = $pfinicio+1;
	if (isset($_GET['pid']) and is_numeric($_GET['pid']) and $_GET['pid'] >= 0) {
	if (($_GET['pid'] + 1) <= (($pfcount / 10))) {
	?><a href="?p=perfil&pf=<?php echo $perfil_get;?>&pid=<?php echo $pfproximo; ?>" class="mostrar_mas fondo">
    	Mostrar más
    </a><?php
	} else {
	?><a href="" class="mostrar_mas fondo">
		No hay nada que mostrar!
	</a><?php
	}
} else {
	?><a href="?p=perfil&pf=<?php echo $perfil_get;?>&pid=<?php echo $pfproximo; ?>" class="mostrar_mas fondo">
    	Mostrar más
    </a><?php
	}
	include("temas/".$prop['tema']."/pie.php");
	?>
	</div>
    <div id="perfil-aside">
        <div id="perfil-aside-content">
            <img src="temas/<?php echo $prop['tema'];?>/imagenes/publicidad.png">
        </div>
        <div id="perfil-aside-content">
            <img src="temas/<?php echo $prop['tema'];?>/imagenes/publicidad.png">
        </div>
        <div id="perfil-aside-content">
            <img src="temas/<?php echo $prop['tema'];?>/imagenes/publicidad.png">
        </div>
    </div>
