<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
# Inicializando GET['pf']
if (isset($_GET['pf'])) {
	$pf_get = depurar($_GET['pf']);
	$pf_true = $db->query("SELECT cuenta FROM cuentas WHERE cuenta = '".$pf_get."'");
	# Para saber si existe la cuenta
	if ($pf_true->num_rows > 0) {
		if ($pf_op = $db->query("
			SELECT idcuenta, cuenta, email, nombre, nacimiento, sexo, imagen_perfil, imagen_perfil_fondo
			FROM cuentas WHERE cuenta = '".$pf_get."'")) {
			$perfil = $pf_op->fetch_array();
			}
		
		# Inicializando GET['pfp']
		if (isset($_GET['pfp'])) {
			$pfp = depurar($_GET['pfp']);
		} else {
			$pfp = 'publicaciones';
			}
		if ($pfp == 'publicaciones' or $pfp == 'favoritos' or $pfp == 'me_gusta') {
			$pfp_act = 'active';
		} else {
			header('Location: ?p=404');
			}
			
		# Contar cuantas publicaciones existen
		if ($pb_counts = $db->query("
			SELECT publicaciones.cuentas_idcuenta, cuentas.idcuenta
			FROM publicaciones 
			INNER JOIN cuentas
			ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
			WHERE cuentas.cuenta = '".$pf_get."'")) {
			$pb_count = ($pb_counts->num_rows);
		}
		# Contar cuantas fav existen
		if ($fav_counts = $db->query("
			SELECT publicaciones.idpublicacion, publicaciones_favoritos.publicaciones_idpublicacion, publicaciones_favoritos.cuentas_idcuenta
			FROM publicaciones_favoritos
			INNER JOIN publicaciones
			ON publicaciones.idpublicacion = publicaciones_favoritos.publicaciones_idpublicacion
			WHERE publicaciones_favoritos.cuentas_idcuenta = '".$perfil['idcuenta']."'")) {
			$fav_count = ($fav_counts->num_rows);
		}
		# Contar cuantas megusta existen
		if ($like_counts = $db->query("
			SELECT publicaciones.idpublicacion, publicaciones_megusta.publicaciones_idpublicacion, publicaciones_megusta.cuentas_idcuenta
			FROM publicaciones_megusta
			INNER JOIN publicaciones
			ON publicaciones.idpublicacion = publicaciones_megusta.publicaciones_idpublicacion
			WHERE publicaciones_megusta.cuentas_idcuenta = '".$perfil['idcuenta']."'")) {
			$like_count = ($like_counts->num_rows);
		}
?>
	<div class="well-bl-perfil" style="background-image: url(static-content/perfiles_fondo/<?php echo $perfil['imagen_perfil_fondo']?>);">  
    	<div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="img-responsive center-block" style="max-width:200px; min-width: 40px;">
                        <a href="#" class="thumbnail thumbnail_perfil" data-toggle="modal" data-target="#perfil_img_modal">
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
                    <li class="<?php
                    if ($pfp == 'publicaciones') {
                        echo 'active_edit';
                        } else {
							echo 'edit';
							}
                    ?>"><a href="<?php echo '?p=perfil&pf='.$perfil['cuenta'].'&pfp=publicaciones';?>"><span class="glyphicon glyphicon-th-list"></span>
                    <span class="hidden-xs"> Publicaciones</span><div class="text-center"><strong><?php echo $pb_count;?></strong></div></a></li>
                    <li class="<?php
                    if ($pfp == 'favoritos') {
                        echo 'active_edit';
                        } else {
							echo 'edit';
							}
                    ?>"><a href="<?php echo '?p=perfil&pf='.$perfil['cuenta'].'&pfp=favoritos';?>"><span class="glyphicon glyphicon-star"></span>
                    <span class="hidden-xs"> Favoritos</span><div class="text-center"><strong><?php echo $fav_count;?></strong></div></a></li>
                    <li class="<?php
                    if ($pfp == 'me_gusta') {
                        echo 'active_edit';
                        } else {
							echo 'edit';
							}
                    ?>"><a href=<?php echo '?p=perfil&pf='.$perfil['cuenta'].'&pfp=me_gusta';?>><span class="glyphicon glyphicon-thumbs-up"></span>
                    <span class="hidden-xs"> Me gusta</span><div class="text-center"><strong><?php echo $like_count;?></strong></div></a></li>
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
			# Inicializando GET['pid']
			if (isset($_GET['pid']) and isset($_GET['pf']) and is_numeric($_GET['pid']) and $_GET['pid'] >= 0) {
				if (($_GET['pid'] + 0.1) <= (($pb_count / 5))) {
					$pfinicio = $_GET['pid'];
				} else {
					header('Location: ?&p=404');  
				}
			} else {
				$pfinicio = 0;
				}
			# Contenido
			$pfinicio_2 = $pfinicio*5;
			$pf_pb = $db->query("
				SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, 
				publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion, publicaciones.puntos,
				publicaciones.imagenes_idimagenes, imagenes.idimagenes, imagenes.ruta
				FROM cuentas
				INNER JOIN publicaciones 
				ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
				INNER JOIN imagenes
				ON publicaciones.imagenes_idimagenes = imagenes.idimagenes
				WHERE cuentas.cuenta = '".$perfil['cuenta']."'
				ORDER BY `idpublicacion` DESC
				LIMIT ".$pfinicio_2.',5');
			while ($nts = $pf_pb->fetch_array()) {
				post($nts);
			}
			# Paginacion
			$link = '?p=perfil&pf='.$perfil['cuenta'].'&pfp=publicaciones&pid';
			$cantidad = 5;
			paginacion($pfinicio, $pb_count, $link, $cantidad);
			break;
			
		/*
		 *	Sección favoritos
		 */
		case 'favoritos';
			# Inicializando GET['pid']
			if (isset($_GET['pid']) and isset($_GET['pf']) and is_numeric($_GET['pid']) and $_GET['pid'] >= 0) {
				if (($_GET['pid'] + 0.1) <= (($fav_count / 5))) {
					$pfinicio = $_GET['pid'];
				} else {
					header('Location: ?&p=404');  
				}
			} else {
				$pfinicio = 0;
				}
			# Contenido
			$pfinicio_2 = $pfinicio*5;
			$pf_pb = $db->query("SELECT
				# Favoritos
				publicaciones_favoritos.idfavorito,
				publicaciones_favoritos.cuentas_idcuenta as idcuenta_fav,
				publicaciones_favoritos.publicaciones_idpublicacion as idpublicacion_fav,
				publicaciones_favoritos.tiempo_de_creacion as idtiempo_fav,
				# Publicaciones  en base de idpublicacion_fav
				publicaciones.cuentas_idcuenta,
				publicaciones.idpublicacion,
				publicaciones.imagenes_idimagenes,
				publicaciones.publicacion,
				publicaciones.tiempo_de_creacion,
				publicaciones.puntos,
				# Cuentas en base de publicaciones.cuentas_idcuenta
				cuentas.cuenta,
				cuentas.idcuenta,
				cuentas.imagen_perfil,
				cuentas.nombre,
				# Imagenes
				imagenes.idimagenes, 
				imagenes.ruta
				FROM publicaciones_favoritos
				INNER JOIN publicaciones
				ON publicaciones.idpublicacion = publicaciones_favoritos.publicaciones_idpublicacion
				INNER JOIN cuentas
				ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
				INNER JOIN imagenes
				ON publicaciones.imagenes_idimagenes = imagenes.idimagenes
				WHERE publicaciones_favoritos.cuentas_idcuenta = ".$perfil['idcuenta']."
				ORDER BY `idfavorito` DESC
				LIMIT ".$pfinicio_2.',5
				');
			while ($nts = $pf_pb->fetch_array()) {
				echo "<div class='well-bl-fav'><span class='glyphicon glyphicon-star'></span><small> Favorito por ".$perfil['cuenta'].' ';
				?><span class="time" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo $nts['idtiempo_fav'];?>"><?php
				echo strtolower(tiempo_transcurrido($nts['idtiempo_fav'])).'</span></small></div>';
				post($nts);
			}
			# Paginacion
			$link = '?p=perfil&pf='.$perfil['cuenta'].'&pfp=favoritos&pid';
			$cantidad = 5;
			paginacion($pfinicio, $fav_count, $link, $cantidad);
			break;
			
		/*
		 *	Sección megusta
		 */
		case 'me_gusta';
			# Inicializando GET['pid']
			if (isset($_GET['pid']) and isset($_GET['pf']) and is_numeric($_GET['pid']) and $_GET['pid'] >= 0) {
				if (($_GET['pid'] + 0.1) <= (($like_count / 5))) {
					$pfinicio = $_GET['pid'];
				} else {
					header('Location: ?&p=404');  
				}
			} else {
				$pfinicio = 0;
				}
			# Contenido
			$pfinicio_2 = $pfinicio*5;
			$pf_pb = $db->query("SELECT
				# Megusta
				publicaciones_megusta.idmegusta,
				publicaciones_megusta.cuentas_idcuenta as idcuenta_fav,
				publicaciones_megusta.publicaciones_idpublicacion as idpublicacion_fav,
				publicaciones_megusta.tiempo_de_creacion as idtiempo_fav,
				# Publicaciones  en base de idpublicacion_fav
				publicaciones.cuentas_idcuenta,
				publicaciones.idpublicacion,
				publicaciones.imagenes_idimagenes,
				publicaciones.publicacion,
				publicaciones.tiempo_de_creacion,
				publicaciones.puntos,
				# Cuentas en base de publicaciones.cuentas_idcuenta
				cuentas.cuenta,
				cuentas.idcuenta,
				cuentas.imagen_perfil,
				cuentas.nombre,
				# Imagenes
				imagenes.idimagenes, 
				imagenes.ruta
				FROM publicaciones_megusta
				INNER JOIN publicaciones
				ON publicaciones.idpublicacion = publicaciones_megusta.publicaciones_idpublicacion
				INNER JOIN cuentas
				ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
				INNER JOIN imagenes
				ON publicaciones.imagenes_idimagenes = imagenes.idimagenes
				WHERE publicaciones_megusta.cuentas_idcuenta = ".$perfil['idcuenta']."
				ORDER BY `idmegusta` DESC
				LIMIT ".$pfinicio_2.',5
				');
			while ($nts = $pf_pb->fetch_array()) {
				echo "<div class='well-bl-fav'><span class='glyphicon glyphicon-thumbs-up'></span><small> Le gusta a ".$perfil['cuenta'].' ';
				?><span class="time" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo $nts['idtiempo_fav'];?>"><?php
				echo strtolower(tiempo_transcurrido($nts['idtiempo_fav'])).'</span></small></div>';
				post($nts);
			}
			# Paginacion
			$link = '?p=perfil&pf='.$perfil['cuenta'].'&pfp=me_gusta&pid';
			$cantidad = 5;
			paginacion($pfinicio, $like_count, $link, $cantidad);
			break;		
	}
	
	# Cierre de $pf_true
	} else {
		header('Location: ?p=404');
	}
	# Cierre de isset GET[pf]
} else {
	header('Location: ?p=404');
}