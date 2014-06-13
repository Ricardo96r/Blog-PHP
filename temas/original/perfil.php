<?php
# Inicializando GET['pf']
if (isset($_GET['pf'])) {
	$pf_get = antiSqlInjection($_GET['pf']);
	
  	if ($pf_op = $db->query("
		SELECT idcuenta, cuenta, email, nombre, nacimiento, sexo, imagen_perfil, imagen_perfil_fondo
		FROM cuentas WHERE cuenta = '".$pf_get."'")) {
		$perfil = $pf_op->fetch_array();
		}
		
	# Inicializando GET['pid']
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
		WHERE cuentas.cuenta = '".$pf_get."'")) {
		$pfcount = ($pfcounts->num_rows);
	}
	
	# Inicializando GET['pfp']
	if (isset($_GET['pfp'])) {
		$pfp = antiSqlInjection($_GET['pfp']);
	} else {
		$pfp = 'publicaciones';
		}
	if ($pfp == 'publicaciones' or $pfp == 'favoritos' or $pfp == 'me_gusta') {
		$pfp_act = 'active';
	} else {
		header('Location: ?p=404');
		}
?>
	<div class="well-bl-perfil" style="background-image: url(static-content/perfiles/<?php echo $perfil['imagen_perfil_fondo']?>);">  
    	<div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="img-responsive center-block" style="max-width:200px; min-width: 40px;">
                        <a href="#" class="thumbnail edit" data-toggle="modal" data-target="#perfil_img_modal">
                          <img src="static-content/perfiles/<?php echo $perfil['imagen_perfil']?>">
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="perfil_img_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></button>
                                <h4 class="modal-title" id="myModalLabel">
									<strong><?php echo $perfil['nombre'];?></strong><small> <?php echo "@".$perfil['cuenta']; ?></small>
                                </h4>
                              </div>
                              <div class="modal-body">
                              	<img class="img-responsive center-block" src="static-content/perfiles/<?php echo $perfil['imagen_perfil']?>">
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h2>
                        <span class="text-center">
                            <div><?php echo $perfil['nombre'];?></div>
                            <div><small><?php echo "@".$perfil['cuenta']; ?></small></div>
                        </span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="well-bl-perfil-nav">
		<div class="container">
        	<div class="row">
            	<div class="col-xs-12">
                <ul class="nav nav-pills">
                    <li <?php
                    if ($pfp == 'publicaciones') {
                        echo 'class=active';
                        }
                    ?>><a href="<?php echo '?p=perfil&pf='.$perfil['cuenta'].'&pfp=publicaciones';?>"><span class="glyphicon glyphicon-th-list"></span>
                    <span class="hidden-xs"> Publicaciones</span><span class="badge">423</span></a></li>
                    <li <?php
                    if ($pfp == 'favoritos') {
                        echo 'class=active';
                        }
                    ?>><a href="<?php echo '?p=perfil&pf='.$perfil['cuenta'].'&pfp=favoritos';?>"><span class="glyphicon glyphicon-star"></span>
                    <span class="hidden-xs"> Favoritos</span><span class="badge">423</span></a></li>
                    <li <?php
                    if ($pfp == 'me_gusta') {
                        echo 'class=active';
                        }
                    ?>><a href=<?php echo '?p=perfil&pf='.$perfil['cuenta'].'&pfp=me_gusta';?>><span class="glyphicon glyphicon-thumbs-up"></span>
                    <span class="hidden-xs"> Me gusta</span><span class="badge">423</span></a></li>
                </ul>
            	</div>
            </div>
        </div>
    </div>
    <div class="section-image"><div class="container"><div class="row"><div class="col-md-8 section" role="main">
	<?php 
	# Contenido
	switch ($pfp) {
		/*
		 *	Sección publicaciones
		 */
		case 'publicaciones':
			$pfinicio_2 = $pfinicio*10;
			$pf_pb = $db->query("
				SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, 
				publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion, 
				publicaciones.imagenes_idimagenes, imagenes.idimagenes, imagenes.ruta
				FROM cuentas
				INNER JOIN publicaciones 
				ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
				INNER JOIN imagenes
				ON publicaciones.imagenes_idimagenes = imagenes.idimagenes
				WHERE cuentas.cuenta = '".$perfil['cuenta']."'
				ORDER BY `idpublicacion` DESC
				LIMIT ".$pfinicio_2.',10');
			while ($nts = $pf_pb->fetch_array()) {
				post($nts);
			}
			break;
			
		/*
		 *	Sección favoritos
		 */
		case 'favoritos';
			$pfinicio_2 = $pfinicio*10;
			# Busqueda de datos para consegir idpublicacion
			$pf_fav_o = $db->query("
				SELECT
				publicaciones_favoritos.idfavorito, publicaciones_favoritos.publicaciones_idpublicacion, 
				publicaciones_favoritos.tiempo_de_creacion, publicaciones_favoritos.cuentas_idcuenta,
				cuentas.idcuenta, cuentas.cuenta
				FROM publicaciones_favoritos
				INNER JOIN cuentas
				ON cuentas.idcuenta = publicaciones_favoritos.cuentas_idcuenta
				WHERE publicaciones_favoritos.cuentas_idcuenta = ".$perfil['idcuenta']."
				ORDER BY `idfavorito` DESC
				LIMIT ".$pfinicio_2.",2");
			$pf_fav = $pf_fav_o->fetch_array();
				
			$pf_pb = $db->query("
				SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, 
				publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion, 
				publicaciones.imagenes_idimagenes, imagenes.idimagenes, imagenes.ruta
				FROM publicaciones
				INNER JOIN cuentas
				ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
				INNER JOIN imagenes
				ON publicaciones.imagenes_idimagenes = imagenes.idimagenes
				WHERE publicaciones.idpublicacion = ".$pf_fav_o.""
				);
			while ($nts = $pf_pb->fetch_array()) {
				post($nts);
			}
			break;
			
		/*
		 *	Sección favoritos
		 */
		case 'me_gusta';
		
			break;		
	}
	
	# Paginacion
	$link = '?p=perfil&pf='.$perfil['cuenta'].'&pid';
	mostrar_mas($pfinicio, $pfcount, $link);
	
# Cierre de isset GET[pf]
} else {
	header('Location: ?p=404');
}