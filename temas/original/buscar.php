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
	$buscar_o = $db->query("
	SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion, publicaciones.imagenes_idimagenes, publicaciones.puntos, imagenes.idimagenes, imagenes.ruta
	FROM cuentas
	INNER JOIN publicaciones 
	ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
	INNER JOIN imagenes
	ON publicaciones.imagenes_idimagenes = imagenes.idimagenes
	WHERE publicacion  LIKE '%".$_GET['q']."%'");
	while ($buscar = $buscar_o->fetch_array()) {
		post($buscar);
		}
	}