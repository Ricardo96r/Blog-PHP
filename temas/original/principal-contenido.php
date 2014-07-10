<?php				
/* 
	PUBLICACIONES 
*/
if (!isset($_GET['pb'])) {
	if($counts = $db->query('SELECT idpublicacion FROM publicaciones')) {
		$count = $counts->num_rows;
	}

if (isset($_GET['pos']) and is_numeric($_GET['pos']) and $_GET['pos'] >= 0) {
	if (($_GET['pos'] + 0.1) <= (($count / 10))) {
		$inicio=$_GET['pos'];
	} else {
		header('Location: ?&p=404');  
	}
} else {
	$inicio=0;
	}
	
$inicio_2 = $inicio*10;
$registros = $db->query('
	SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion, publicaciones.imagenes_idimagenes, publicaciones.puntos, imagenes.idimagenes, imagenes.ruta
	FROM cuentas
	INNER JOIN publicaciones 
	ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
	INNER JOIN imagenes
	ON publicaciones.imagenes_idimagenes = imagenes.idimagenes
	ORDER BY `idpublicacion` DESC
	LIMIT '.$inicio_2.',10');	
$imp = 0;
while ($reg = $registros->fetch_assoc()) {
	post($reg);
	$imp++;
	if($imp == 5) {
		?>
		<div class="well-bl-2 visible-xs visible-sm"><div class="row"><div class="col-xs-12"><?php publicidad(); ?></div></div></div>
		<?php
	}	
}
	
$link = '?pos';
mostrar_mas($inicio, $count, $link);
		
/* 
	COMENTARIOS
	$getpb=$_GET['pb']; pagina de publicacion
	$count = numero de comentarios
	$getcom=$_GET['com']; pagina de comentarios
	$getcom_2 = $getcom * 10; para el limit de mysql
	$pb = publicacion
*/
} else {
	# GET pb para saber que id es la publicacion
	if (isset($_GET['pb']) and is_numeric($_GET['pb']) and $_GET['pb'] >= 0 ) {
		$getpb=$_GET['pb'];
		# Contar los comentarios
		if($counts = $db->query('SELECT idcomentario, publicaciones_idpublicacion FROM comentarios WHERE publicaciones_idpublicacion = '.$getpb)) {
			$count = ($counts->num_rows);
		}
		# GET com para saber que id es el comentario
		if (isset($_GET['com']) and is_numeric($_GET['com']) and $_GET['com'] >= 0) {
			# Para saber hasta que numero llega $_GET['com'] y evitar problemas de seguridad.
			if (($_GET['com'] + 0.1) <= (($count / 10))) {
				$getcom=$_GET['com'];
			} else {
				header('Location: ?&p=404');  
			}
		# Si el $_GET['com'] no existe o no es un numero y mayor a 0 sera $getcom = 0.
		} else {
			$getcom=0;
			}
			
		# Inicializando GET['tp']
		if (isset($_GET['tp'])) {
			if ($_GET['tp'] == 'recientes' or $_GET['tp'] == 'populares' or $_GET['tp'] == 'orden') {
				$tp = $_GET['tp'];
			} else {
				$tp = 'populares';
				}
		} else {
			$tp = 'populares';
			}
			
		$getcom_2 = $getcom * 10;
		
		switch ($tp) {
			case 'populares':
				# Revisar
				$com_o=$db->query('
				SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, comentarios.cuentas_idcuenta, comentarios.publicaciones_idpublicacion, comentarios.comentario, comentarios.tiempo_de_creacion, comentarios.idcomentario, comentarios.puntos,publicaciones.idpublicacion
				FROM comentarios 
				INNER JOIN publicaciones
				ON publicaciones.idpublicacion = comentarios.publicaciones_idpublicacion
				INNER JOIN cuentas
				ON cuentas.idcuenta = comentarios.cuentas_idcuenta
				WHERE publicaciones.idpublicacion='.$getpb.'
				ORDER BY `puntos` DESC
				LIMIT '.$getcom_2.',10');
				break;
			case 'recientes':
				$com_o=$db->query('
				SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, comentarios.cuentas_idcuenta, comentarios.publicaciones_idpublicacion, comentarios.comentario, comentarios.tiempo_de_creacion, comentarios.idcomentario, comentarios.puntos, publicaciones.idpublicacion
				FROM comentarios 
				INNER JOIN publicaciones
				ON publicaciones.idpublicacion = comentarios.publicaciones_idpublicacion
				INNER JOIN cuentas
				ON cuentas.idcuenta = comentarios.cuentas_idcuenta
				WHERE publicaciones.idpublicacion='.$getpb.'
				ORDER BY `idcomentario` DESC
				LIMIT '.$getcom_2.',10');
				break;
			case 'orden':
				$com_o=$db->query('
				SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, comentarios.cuentas_idcuenta, comentarios.publicaciones_idpublicacion, comentarios.comentario, comentarios.tiempo_de_creacion, comentarios.idcomentario, comentarios.puntos, publicaciones.idpublicacion
				FROM comentarios 
				INNER JOIN publicaciones
				ON publicaciones.idpublicacion = comentarios.publicaciones_idpublicacion
				INNER JOIN cuentas
				ON cuentas.idcuenta = comentarios.cuentas_idcuenta
				WHERE publicaciones.idpublicacion='.$getpb.'
				ORDER BY `idcomentario` ASC
				LIMIT '.$getcom_2.',10');
				break;
		}
	} else {
		header('Location: ?p=404');
	}
	
	if(isset($getpb)) {
		if ($pb_o = $db->query('
		SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombre, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion, publicaciones.imagenes_idimagenes, publicaciones.puntos, imagenes.idimagenes, imagenes.ruta
		FROM cuentas
		INNER JOIN publicaciones 
		ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
		INNER JOIN imagenes
		ON publicaciones.imagenes_idimagenes = imagenes.idimagenes
		WHERE idpublicacion = '.$getpb)) {
			$pb = $pb_o->fetch_assoc();
		}
		?><div class="height-pb"><?php post($pb);?></div>



		<?php
		if(isset($_SESSION['username'])) {
			if(!isset($_POST['enviar_nota'])) {
				?>
				<script>
                function comentario(msg, idmsg){
                        var parametros = {
                                "msg" : msg,
                                "idmsg" : idmsg,
                        };
                        $.ajax({
                                data:  parametros,
                                url:   '?p=ajax&action=comentario',
                                type:  'post',
                                beforeSend: function () {
									new Spinner(opts).spin(document.getElementById('resultado'));
                                },
                                success:  function (respuesta) {
									$('#resultado').html((respuesta == 'Comentario enviado') 
									? location.reload() : respuesta);
                                }
                        });
                }
                </script>   
				<div class="">
                	
                	<div class="well-bl-form">
                    	<h1>Comentarios</h1>
                        <ul class="nav nav-pills">
                       		<li <?php if($tp=='populares'){echo"class='active'";}?>><a href="?pb=<?php echo $getpb?>&tp=populares"><span class="glyphicon glyphicon-fire"></span><span class="hidden-xs"> Populares</span></a></li>
                            <li <?php if($tp=='recientes'){echo"class='active'";}?>><a href="?pb=<?php echo $getpb?>&tp=recientes"><span class="glyphicon glyphicon-time"></span><span class="hidden-xs"> Recientes</span></a></li>
                            <li <?php if($tp=='orden'){echo"class='active'";}?>><a href="?pb=<?php echo $getpb?>&tp=orden"><span class="glyphicon glyphicon-list"></span><span class="hidden-xs"> En orden</span></a></li>
                            <li class="pull-right"> 
                                <a href="" data-toggle="modal" data-target="#responder_publicacion">
                                  <span class="glyphicon glyphicon-pencil"></span><span class="hidden-xs"> Responder</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="responder_publicacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Responder a <strong><?php echo $pb['nombre'];?></strong>
                              - <small>@<?php echo $pb['cuenta'];?></small></h4>
                          </div>
                          <div class="modal-body">
                          	<form method="post" action="">
                                <textarea rows="5" class="form-control" id="comentario" type="text" name="comentario" maxlength="400" required></textarea>
                                <div class="text-center text-danger" id="resultado"></div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <buttom class="btn btn-warning" name="enviar_notas"
                                onclick="comentario($('#comentario').val(), <?php echo $getpb;?>);return false;">Enviar comentario</buttom>
                          </div>
                        </div>
                      </div>
                    </div>
                </div><?php
				
            } else {
				?><div class="well-bl-1"><?php
					if ($idcuentap = $db->query('SELECT idcuenta, email FROM cuentas WHERE email = '.$_SESSION['username'])) {
						$idcuentap2 = $idcuentap->fetch_assoc();
					}
                $idcuenta = $idcuentap2['idcuenta'];
                $comentario = antiSqlInjection($_POST['comentario']);
                if(!isset($comentario) and empty($comentario)) {
                    echo 'Porfavor no deje campos vacios';
                } elseif(strlen($comentario) < 20) {
                    echo 'La nota es muy corta, tiene que tener mas de 20 caracteres';
                } elseif(strlen($comentario) > 400){
                    echo 'El comentario es muy largo, el máximo de caracteres es 400';
                } else {
                $enviar_nota = $db->query('
					INSERT INTO `comentarios` (`cuentas_idcuenta`, `publicaciones_idpublicacion`, `comentario`) 
					VALUES ('.$idcuenta.','.$getpb.','.$comentario.')');
				
                echo 'Comentario enviado';
				?></div><?php
                    }
                }
		} else {
			#revisar
		}
		while ($cm = $com_o->fetch_assoc()) {
			comentario($cm);
			}
		$link = '?pb=$getpb&com';
		mostrar_mas($getcom, $count, $link);
	} else {
		header('Location: ?&pos=$inicio');
		}
		?>
<?php }