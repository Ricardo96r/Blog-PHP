<?php
if (isset($_GET['pf'])) {
	$perfil_get = antiSqlInjection($_GET['pf']);
  	if ($perfil_op = $db->query("
		SELECT idcuenta, cuenta, email, nombre, nacimiento, sexo, imagen_perfil, imagen_perfil_fondo
		FROM cuentas WHERE cuenta = '$perfil_get'")) {
		$perfil = $perfil_op->fetch_array();
		}
	
	/*
		Necesario para el LIMITE de PUBLICACIONES, atraves de MOSTRAR MAS
	*/
	if (isset($_GET['pid']) and isset($_GET['pf']) and is_numeric($_GET['pid']) and $_GET['pid'] >= 0) {
		$pfinicio = $_GET['pid'];
	} else {
		$pfinicio = 0;
		}
	if ($pfcounts = $db->query("
		SELECT publicaciones.cuentas_idcuenta, cuentas.idcuenta
		FROM publicaciones 
		INNER JOIN cuentas
		ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
		WHERE cuentas.cuenta = '$perfil_get'")) {
		$pfcount = ($pfcounts->num_rows);
	}
} else {
	header("Location: ?p=404");
}

if (!isset($perfil) or !isset($perfil_get) or empty($perfil) or empty($perfil_get)) {
	header("Location: ?p=404");
} else {
	$pfinicio_2 = $pfinicio*10;
	$perfil_notas = $db->query("
		SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion, publicaciones.imagenes_idimagenes, imagenes.idimagenes, imagenes.ruta
		FROM cuentas
		INNER JOIN publicaciones 
		ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
		INNER JOIN imagenes
		ON publicaciones.imagenes_idimagenes = imagenes.idimagenes
		WHERE cuentas.cuenta = '$perfil[cuenta]'
		ORDER BY `idpublicacion` DESC
		LIMIT $pfinicio_2,10");?>
<div class="row">
<div class="col-sm-12">      
<div class="well-bl-perfil">
    <div class="row">
		<div class="col-sm-4">
            <div class="img-responsive center-block" style="max-width:260px; min-width: 40px;">
                <a href="#" class="thumbnail">
                  <img src="static-content/perfiles/<?php echo $perfil['imagen_perfil']?>">
                </a>
            </div>
		</div>
		<div class="col-sm-8">
        	<div class="row">
            	<div class="col-sm-12">
               		<h2>
                    	<span class="hidden-xs">
							<?php echo $perfil['nombre'];?>
                            <div><small><?php echo "@".$perfil['cuenta']; ?></small></div>
                        </span>
                        <span class="visible-xs text-center">
							<?php echo $perfil['nombre'];?>
                            <div><small><?php echo "@".$perfil['cuenta']; ?></small></div>
                        </span>
                    </h2>
                </div>
            </div>
        </div>
	</div>
    <div class="row" style="background-color:#FFF4E6;">
        <div class="col-xs-12">
            <ul class="nav nav-pills">
                <li><a href="#"><span class="glyphicon glyphicon-th-list"></span>
                <span class="hidden-xs"> Publicaciones</span><span class="badge">423</span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span>
                <span class="hidden-xs"> Favoritos</span><span class="badge">423</span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-thumbs-up"></span>
                <span class="hidden-xs"> Me gusta</span><span class="badge">423</span></a></li>
            </ul>
        </div>
	</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-8 section" role="main">
	<?php #PUBLICACIONES ?>
    <div class="row"><div class="col-xs-12"><?php			
		while ($nts = $perfil_notas->fetch_array()) {
			post($nts);
			} ?>
	</div></div>
<?php 
			$link = "?p=perfil&pf=$perfil[cuenta]&pid";
			mostrar_mas($pfinicio, $pfcount, $link);
}