<?php if (!isset($_GET['q'])) {?>
<div class="well-bl-form">
    <div class="page-header">
        <h1>Buscar</h1>
    </div>
    <?php if(!isset($_POST['submit_buscar'])) {?>
    <form method="post" action="">
        <div class="form-group">
            <input class="form-control" type="text" name="buscar_text" id="buscar_input" maxlength="30" placeholder="buscar" required>
        </div>
        <div class="form-group">
            <button class="btn btn-warning form-control" name="submit_buscar">Realizar busqueda</button>
        </div>
    </form>
    <?php } else {
		header('Location: ?p=buscar&q='.$_POST['buscar_text']);
		}?>
</div>
<?php } else {
	$q = antiSqlInjection($_GET['q']);?>
	<div class="well-bl-form">
        <h1>Buscar: <small><?php echo $q;?></small></h1>
	</div><?php
	$bsql = "
	SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion, publicaciones.imagenes_idimagenes, publicaciones.puntos, imagenes.idimagenes, imagenes.ruta
	FROM cuentas
	INNER JOIN publicaciones 
	ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
	INNER JOIN imagenes
	ON publicaciones.imagenes_idimagenes = imagenes.idimagenes
	WHERE publicacion  LIKE '%".$q."%'";
	
	$bcount_o = $db->query($bsql);
	$bcount = ($bcount_o->num_rows);

	if (isset($_GET['bp']) and is_numeric($_GET['bp']) and $_GET['bp'] >= 0) {
		if (($_GET['bp'] + 0.1) <= (($bcount / 10))) {
			$getbp=$_GET['bp'];
		} else {
			header('Location: ?&p=404');  
		}
	} else {
		$getbp=0;
		}
	
	$getbp_2 = $getbp * 10;
	$buscar_o = $db->query($bsql."LIMIT ".$getbp_2.",5");
	
	while ($buscar = $buscar_o->fetch_array()) {
		post($buscar);
		}

	$link = '?p=buscar&q='.$q.'&bp';
	
	mostrar_mas($getbp, $bcount, $link);
	}