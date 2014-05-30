
<?php

if (isset($_GET['pf'])) {
	$perfil_get = antiSqlInjection($_GET['pf']);
  	$perfil_op = mysql_query("
		SELECT idcuenta, cuenta, email, nombre, nacimiento, sexo, imagen_perfil, imagen_perfil_fondo
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
			SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion, publicaciones.imagenes_idimagenes, imagenes.idimagenes, imagenes.ruta
			FROM cuentas
			INNER JOIN publicaciones 
			ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
			INNER JOIN imagenes
			ON publicaciones.imagenes_idimagenes = imagenes.idimagenes
			WHERE cuentas.cuenta = '$perfil[cuenta]'
			ORDER BY `idpublicacion` DESC
			LIMIT $pfinicio_2,10", $conn) or die(mysql_error());?>
            
	<div class="well-bl-1">
    <div class="row">
    	<div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <img class="img-perfil center-block" src="static-content/perfiles/<?php echo $perfil['imagen_perfil']?>">
                </div>
            </div>
            <h4>
            <div class="row">
                <div class="col-xs-12 text-center">
            		<?php echo $perfil['nombre'];?>
            	</div>
            </div>
			<div class="row">
                <div class="col-xs-12 text-center">
            		<small><?php echo "@".$perfil['cuenta']; ?></small>
            	</div>
            </div>
            </h4>
		</div>
	</div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills">
				<li><a href="#"><span class="glyphicon glyphicon-th-list"></span><span class="hidden-xs"> Publicaciones</span><span class="badge">423</span></a></li>
				<li><a href="#"><span class="glyphicon glyphicon-star"></span><span class="hidden-xs"> Favoritos</span><span class="badge">423</span></a></li>
				<li><a href="#"><span class="glyphicon glyphicon-thumbs-up"></span><span class="hidden-xs"> Me gusta</span><span class="badge">423</span></a></li>
            </ul>
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
	?>
	</div>