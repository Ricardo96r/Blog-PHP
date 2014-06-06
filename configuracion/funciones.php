<?php 

/* 
	Ubicacion de utilizacion: 
		fuente/publico/registro.php
	¿Que es?:
		Registro de nacimiento 
*/

function antiSqlInjection( $variable ) {
	global $db;
	if (isset($variable)) {
		$result = strip_tags($variable);               // funcion que elimina etiquetas html y php
		$result = stripslashes($variable);           // funcion que elimina las barras invertidas 
		$result = htmlentities($variable);       //elimina etiquetas html y javascrip
		$result = $db->real_escape_string($variable); //elimina todo lo que tenga que ver con mysql
	} else {
		$result = "";
		}
	return $result;							
}

function mostrarNacimiento( $type ) {
	if ($type == 'mes') {
		echo "
			<select name=\"mes\" class=\"form-control\" id=\"mes\">
				<option value=\"mes\">Mes</option>
				<option value=\"1\">
					Enero
				</option>	
				<option value=\"2\">
					Febrero
				</option>	
				<option value=\"3\">
					Marzo
				</option>	
				<option value=\"4\">
					Abril
				</option>	
				<option value=\"5\">
					Mayo
				</option>	
				<option value=\"6\">
					Junio
				</option>	
				<option value=\"7\">
					Julio
				</option>
				<option value=\"8\">
					Agosto
				</option>
				<option value=\"9\">
					Septiembre
				</option>
				<option value=\"10\">
					Octubre
				</option>
				<option value=\"11\">
					Noviembre
				</option>
				<option value=\"12\">
					Diciembre
				</option>
			</select>
	";
	}
	if ($type == 'dia') {
		echo "<select name=\"dia\" class=\"form-control\" id=\"dia\">";
		echo "<option value=\"day\">Día</option>";
		$maxdy = 31;
		for ($i = 1; $i <= $maxdy; $i++)
		{
			echo "<option value=\"$i\">$i</option>";
		}
		echo "</select>";
	}
	if ($type == 'año') {
		echo "<select name=\"año\" class=\"form-control\" id=\"año\">";
		echo "<option value=\"año\">Año</option>";
		for ($i = date('Y'); $i >= 1900; $i--)
		{
			echo "<option value=\"$i\">$i</option>";
		}	 
		
		echo "</select>";
	}
}

function post ($dt) {
	global $prop; //Para usar la global $prop en una funcion
	global $db;
	?>
    <div class="well-bl-1">
        <div class="row">
            <div class="col-xs-12">
            	<div class="pb-top">
                    <a href="?p=perfil&pf=<?php echo $dt['cuenta'];?>">
                    <div class="pull-left pb-ftpf">
                        <img class="image-sm" src="static-content/perfiles/<?php echo $dt['imagen_perfil']?>">
                    </div>
                    
                    <div>
                    <?php echo $dt['nombre']."" ?></a>
                    <a class="a-clear" href="?p=perfil&pf=<?php echo $dt['cuenta'];?>"><?php echo " - @".$dt['cuenta']."" ?></a>     
                    </div>
                    
                    <span class="time" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo $dt['tiempo_de_creacion'];?>">
                    <?php echo "<small>".tiempo_transcurrido($dt['tiempo_de_creacion'])."</small>";?>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="pb-pb center-block">
                <?php if (!isset($dt['idcomentario'])) {?>
                    <a class='a-clear' href='?pb=<?php echo $dt['idpublicacion']; ?>'>
                        <?php echo "<img class='image-md center-block' src="."static-content/publicaciones/".$dt['ruta'].">"; ?>
                        <div class="center-block pb-text">
                            <?php echo $dt['publicacion']; ?>
                        </div>
                    </a>
                <?php } else {?>
                        <?php echo $dt['comentario']; ?>
                <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="pb-bottom">
                    <ul class="nav nav-pills">
                    	<?php /* Me gusta */ ?>
                        <script>
						function me_gusta_<?php echo $dt['idpublicacion']?>(idpb){
								var parametros = {
										"idpb" : idpb,
								};
								$.ajax({
										data:  parametros,
										url:   '?p=ajax&action=publicaciones_megusta',
										type:  'post',
										beforeSend: function () {
											new Spinner(opts).spin(document.getElementById('resultado_<?php echo $dt['idpublicacion']?>'))
												
										},
										success:  function (response) {
												$("#resultado_<?php echo $dt['idpublicacion']?>").html(response);
										}
								});
						}
						</script>
                      <?php
					  	if ($mg_p = $db->query("SELECT * FROM publicaciones_megusta WHERE publicaciones_idpublicacion = '$dt[idpublicacion]'")) {
							$mg = $mg_p->num_rows;
						}
					  ?>
                      <li onclick="me_gusta_<?php echo $dt['idpublicacion']?>(<?php echo $dt['idpublicacion']; ?>);return false;"><a>
                      <span class="glyphicon glyphicon-thumbs-up"></span><span class="hidden-xs"> Me gusta</span>
                      <span class="badge" id="resultado_<?php echo $dt['idpublicacion']?>"><?php echo $mg;?></span>
                      </a></li>
                      
                      <?php /* Favoritos */ ?>
                      	<script>
						function favoritos_<?php echo $dt['idpublicacion']?>(idpb){
								var parametros = {
										"idpb" : idpb,
								};
								$.ajax({
										data:  parametros,
										url:   '?p=ajax&action=publicaciones_favoritos',
										type:  'post',
										beforeSend: function () {
											new Spinner(opts).spin(document.getElementById('fav_<?php echo $dt['idpublicacion']?>'));
										},
										success:  function (response) {
												$("#fav_<?php echo $dt['idpublicacion']?>").html(response);
										}
								});
						}
						</script>
                      <?php
					  	if ($fav_p = $db->query("SELECT * FROM publicaciones_favoritos WHERE publicaciones_idpublicacion = '$dt[idpublicacion]'")) {
							$fav = $fav_p->num_rows;
						}
					  ?>
                      <li onclick="favoritos_<?php echo $dt['idpublicacion']?>(<?php echo $dt['idpublicacion']; ?>);return false;"><a>
                      <span class="glyphicon glyphicon-star"></span><span class="hidden-xs"> Favoritos</span>
                      <span class="badge" id="fav_<?php echo $dt['idpublicacion']?>"><?php echo $fav;?></span>
                      </a></li>
                      
                      <?php
					  	if ($com_p = $db->query("SELECT * FROM comentarios WHERE publicaciones_idpublicacion = '$dt[idpublicacion]'")) {
							$com = $com_p->num_rows;
						}
					  ?>
                      <li><a href="?pb=<?php echo $dt['idpublicacion']; ?>">
                      <span class="glyphicon glyphicon-comment"></span><span class="hidden-xs"></span>
                      <span class="badge"><?php echo $com;?></span>
                      </a></li>
                      
                        <li class="dropup  pull-right">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                              <span class="glyphicon glyphicon-th"></span><span class="hidden-xs"> Compartir</span><span class="caret"></span>
                            </a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Tuenti</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Otro</a></li>
                          </ul>
                       </li>
                    </ul>
                </div>
            </div>
        </div>
	</div>
<?php } 

function publicidad () {
	global $prop;?>
	<img class="center-block" src="temas/<?php echo $prop['tema'];?>/imagenes/publicidad.png" >
	<?php }
	

function tiempo_transcurrido($fecha) {
	if(empty($fecha)) {
		return "No hay fecha";
	}
 
	$intervalos = array("segundo", "minuto", "hora", "dí­a", "semana", "mes", "año");
	$duraciones = array("60","60","24","7","4.35","12");
 
	$ahora = time();
	$Fecha_Unix = strtotime($fecha);
 
	if(empty($Fecha_Unix)) {  
		return "Fecha incorrecta";
	}
	if($ahora > $Fecha_Unix) {  
		$diferencia     = $ahora - $Fecha_Unix;
		$tiempo         = "Hace";
	} else {
		$diferencia     = $Fecha_Unix - $ahora;
		$tiempo         = "Dentro de";
	}
	for($j = 0; $diferencia >= $duraciones[$j] && $j < count($duraciones)-1; $j++) {
		$diferencia /= $duraciones[$j];
	}
 
	$diferencia = round($diferencia);
 
	if($diferencia != 1) {
		$intervalos[5].="e"; //meses... la magia del español
		$intervalos[$j].= "s";
	}
 
	return "$tiempo $diferencia $intervalos[$j]";
}

function mostrar_mas($get, $count, $link) {
	if (isset($get) and is_numeric($get) and $get >= 0) {
		$count /= 10;
		$gt = $get;
	?>
	<div class='well-bl-2 visible-xs visible-sm'><div class='row'><div class='col-xs-12'><?php publicidad();?></div></div></div>
 	
	<?php if ($get +1 >= $count) {?><div class="well-bl-1 text-center"><strong>No hay nada mas que mostrar</strong></div><?php }else {}?>
        
        <div class='row'>
    		<div class='col-xs-12'>
    			<div class='text-center'>
					<ul class='pagination pagination-lg'><?php
                      if ($count != 0) {
                      	if ($get == 0) {
						  echo "<li class='disabled'><a>&laquo; Anterior</a></li>";
						 } else {
						  echo "<li><a href='".$link."=".($get-1)."'>&laquo; Anterior</a></li>";
						 }
					
					# Si get == 0
                      if ($get == 0) {
						echo "<li class='active hidden-xs'><a href=".$link."=".($get).">".($get)."</a></li>";
						if ($get + 1 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+1)."</a></li>";
						    } else {
							   echo "<li class='hidden-xs'><a href=".$link."=".($get+1).">".($get +1)."</a></li>";
							    } 
                      	if ($get + 2 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+2)."</a></li>";
						    } else {
							   echo "<li class='hidden-xs'><a href=".$link."=".($get+2).">".($get +2)."</a></li>";
							    } 
						if ($get + 3 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+3)."</a></li>";
						    } else {
							   echo "<li class='hidden-xs'><a href=".$link."=".($get+3).">".($get +3)."</a></li>";
							    } 
						if ($get + 4 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+4)."</a></li>";
						    } else {
							   echo "<li class='hidden-xs'><a href=".$link."=".($get+4).">".($get +4)."</a></li>";
							    } 
								
					  # SI GET = 1
					  } else if ($get == 1) {
						echo "<li class='hidden-xs'><a href=".$link."=".($get-1).">".($get -1)."</a></li>"; 
						echo "<li class='active hidden-xs'><a href=".$link."=".($get).">".($get)."</a></li>";
						if ($get + 1 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+1)."</a></li>";
						    } else {
							   echo "<li class='hidden-xs'><a href=".$link."=".($get+1).">".($get +1)."</a></li>";
							    } 
                      	if ($get + 2 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+2)."</a></li>";
						    } else {
							   echo "<li class='hidden-xs'><a href=".$link."=".($get+2).">".($get +2)."</a></li>";
							    }
						if ($get + 3 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+3)."</a></li>";
						    } else {
							   echo "<li class='hidden-xs'><a href=".$link."=".($get+3).">".($get +3)."</a></li>";
							    } 
                       		 
					   
						#Si get > 1
					  } else {
						echo "<li class='hidden-xs'><a href=".$link."=".($get-2).">".($get -2)."</a></li>";
						echo "<li class='hidden-xs'><a href=".$link."=".($get-1).">".($get -1)."</a></li>"; 
						echo "<li class='active hidden-xs'><a href=".$link."=".($get).">".($get)."</a></li>";
						if ($get + 1 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+1)."</a></li>";
						    } else {
							   echo "<li class='hidden-xs'><a href=".$link."=".($get+1).">".($get +1)."</a></li>";
							    } 
                      	if ($get + 2 >= $count) { 
						   echo "<li class='disabled hidden-xs'><a>".($get+2)."</a></li>";
						    } else {
							   echo "<li class='hidden-xs'><a href=".$link."=".($get+2).">".($get +2)."</a></li>";
							    }
					  }
						if($get+1 >= $count) {
						  echo "<li class='disabled'><a>Siguiente &raquo;</a></li>";
						  } else {
						  echo "<li><a href='".$link."=".($get+1)."'>Siguiente &raquo;</a></li>";
							}
					#No hay nada esto pasa cuando count vale 0!
					  } else {
						  }
		?></ul></div></div></div><?php
		
	} else {
		header("Location: ?p=404");
		}
	}

function comentario ($dt) {
	global $prop; //Para usar la global $prop en una funcion
	global $db;
	?>
    <div class="well-bl-1">
        <div class="row">
            <div class="col-xs-12">
            	<div class="pb-top">
                    <a href="?p=perfil&pf=<?php echo $dt['cuenta'];?>">
                    <div class="pull-left pb-ftpf">
                        <img class="image-sm" src="static-content/perfiles/<?php echo $dt['imagen_perfil']?>">
                    </div>
                    
                    <div>
                    <?php echo $dt['nombre']."" ?></a>
                    <a class="a-clear" href="?p=perfil&pf=<?php echo $dt['cuenta'];?>"><?php echo " - @".$dt['cuenta']."" ?></a>     
                    </div>
                    
                    <span class="time" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo $dt['tiempo_de_creacion'];?>">
                    <?php echo "<small>".tiempo_transcurrido($dt['tiempo_de_creacion'])."</small>";?>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="pb-pb center-block">
					<?php echo $dt['comentario']; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="pb-bottom">
                    <ul class="nav nav-pills">
                    	<?php /* Me gusta */ ?>
                        <script>
						function comentarios_megusta_<?php echo $dt['idcomentario']?>(idcom){
								var parametros = {
										"idcom" : idcom,
								};
								$.ajax({
										data:  parametros,
										url:   '?p=ajax&action=comentarios_megusta',
										type:  'post',
										beforeSend: function () {
											new Spinner(opts).spin(document.getElementById('comentario_megusta_<?php echo $dt['idcomentario']?>'));
										},
										success:  function (response) {
												$("#comentario_megusta_<?php echo $dt['idcomentario']?>").html(response);
										}
								});
						}
						</script>
                      <?php
					  	if ($mg_p = $db->query("SELECT * FROM comentarios_megusta WHERE comentarios_idcomentario = '$dt[idcomentario]'")) {
							$mg = $mg_p->num_rows;
						}
					  ?>
                      <li onclick="comentarios_megusta_<?php echo $dt['idcomentario']?>(<?php echo $dt['idcomentario']; ?>);return false;"><a>
                      <span class="glyphicon glyphicon-thumbs-up"></span><span class="hidden-xs"> Me gusta</span>
                      <span class="badge" id="comentario_megusta_<?php echo $dt['idcomentario']?>"><?php echo $mg;?></span>
                      </a></li>
                      
                      <?php /* Favoritos */ ?>
                      	<script>
						function comentarios_favoritos_<?php echo $dt['idcomentario']?>(idcom){
								var parametros = {
										"idcom" : idcom,
								};
								$.ajax({
										data:  parametros,
										url:   '?p=ajax&action=comentarios_favoritos',
										type:  'post',
										beforeSend: function () {
											new Spinner(opts).spin(document.getElementById('comentario_fav_<?php echo $dt['idcomentario']?>'));
										},
										success:  function (response) {
												$("#comentario_fav_<?php echo $dt['idcomentario']?>").html(response);
										}
								});
						}
						</script>
                      <?php
					  	if ($fav_p = $db->query("SELECT * FROM comentarios_favoritos WHERE comentarios_idcomentario = '$dt[idcomentario]'")) {
							$fav = $fav_p->num_rows;
						}
					  ?>
                      <li onclick="comentarios_favoritos_<?php echo $dt['idcomentario']?>(<?php echo $dt['idcomentario']; ?>);return false;"><a>
                      <span class="glyphicon glyphicon-star"></span><span class="hidden-xs"> Favoritos</span>
                      <span class="badge" id="comentario_fav_<?php echo $dt['idcomentario']?>"><?php echo $fav;?></span>
                      </a></li>
                      
                      <?php
					  	if ($com_p = $db->query("SELECT * FROM subcomentarios WHERE comentarios_idcomentario = '$dt[idcomentario]'")) {
							$com = $com_p->num_rows;
						}
					  ?>
                      <li><a>
                      <span class="glyphicon glyphicon-comment"></span><span class="hidden-xs"></span>
                      <span class="badge"><?php echo $com;?></span>
                      </a></li>
                      
                      
                        <li class="pull-right responder-comentario" data-toggle="tooltip" data-placement="top" title="" data-original-title="Responder">
                            <a data-toggle="modal" data-target="#comentario_subcomentario_<?php echo $dt['idcomentario']?>">
                              <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        <!-- Modal -->
                        <div class="modal fade" id="comentario_subcomentario_<?php echo $dt['idcomentario']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Responder a <strong><?php echo $dt['nombre'];?></strong>
                                 - <small>@<?php echo $dt['cuenta'];?></small></h4>
                              </div>
                              <div class="modal-body">
								<script>
								function subcomentario_<?php echo $dt['idcomentario']?>(msg, idmsg){
										var parametros = {
												"msg" : msg,
												"idmsg" : idmsg,
										};
										$.ajax({
												data:  parametros,
												url:   '?p=ajax&action=subcomentario',
												type:  'post',
												beforeSend: function () {
													new Spinner(opts).spin(document.getElementById('resultado_subcomentario_<?php echo $dt['idcomentario']?>'));
												},
												success:  function (response) {
														$("#resultado_subcomentario_<?php echo $dt['idcomentario']?>").html(response);
												}
										});
								}
								</script>  
                              <form method="post" action="">
                                <textarea rows="5" class="form-control" id="subcomentario_<?php echo $dt['idcomentario']?>" type="text" name="comentario" maxlength="400" required></textarea>
                                <div class="text-center" id="resultado_subcomentario_<?php echo $dt['idcomentario']?>"></div>
                              </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <buttom class="btn btn-warning" name="enviar_notas"
                                onclick="subcomentario_<?php echo $dt['idcomentario']?>($('#subcomentario_<?php echo $dt['idcomentario']?>').val(), <?php echo $dt['idcomentario']?>);return false;">Enviar subcomentario</buttom>
                              </div>
                            </div>
                          </div>
                        </div>
                       </li>
                    </ul>
                </div>
            </div>
        </div>
	</div>
<?php } 