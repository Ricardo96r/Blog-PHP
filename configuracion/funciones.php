<?php 

/* 
	Ubicacion de utilizacion: 
		fuente/publico/registro.php
	¿Que es?:
		Registro de nacimiento 
*/

function antiSqlInjection( $variable ) {
	if (isset($variable)) {
		$variable = strip_tags($variable);               // funcion que elimina etiquetas html y php
		$variable = stripslashes($variable);           // funcion que elimina las barras invertidas 
		$variable = htmlentities($variable);       //elimina etiquetas html y javascrip
		$variable = mysql_real_escape_string($variable); //elimina todo lo que tenga que ver con mysql
	} else {
		$variable = "";
		}
	return $variable;							
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
										url:   '<?php echo "temas/".$prop['tema']."/ajax/publicaciones_megusta.php"; ?>',
										type:  'post',
										beforeSend: function () {
												$("#resultado_<?php echo $dt['idpublicacion']?>").html("O");
										},
										success:  function (response) {
												$("#resultado_<?php echo $dt['idpublicacion']?>").html(response);
										}
								});
						}
						</script>
                      <?php
					  	$mg_p = mysql_query("SELECT * FROM publicaciones_megusta WHERE publicaciones_idpublicacion = '$dt[idpublicacion]'") or die(mysql_error());
						$mg = mysql_num_rows($mg_p);
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
										url:   '<?php echo "temas/".$prop['tema']."/ajax/publicaciones_favoritos.php"; ?>',
										type:  'post',
										beforeSend: function () {
												$("#fav_<?php echo $dt['idpublicacion']?>").html("Enviando");
										},
										success:  function (response) {
												$("#fav_<?php echo $dt['idpublicacion']?>").html(response);
										}
								});
						}
						</script>
                      <?php
					  	$fav_p = mysql_query("SELECT * FROM publicaciones_favoritos WHERE publicaciones_idpublicacion = '$dt[idpublicacion]'") or die(mysql_error());
						$fav = mysql_num_rows($fav_p);
					  ?>
                      <li onclick="favoritos_<?php echo $dt['idpublicacion']?>(<?php echo $dt['idpublicacion']; ?>);return false;"><a>
                      <span class="glyphicon glyphicon-star"></span><span class="hidden-xs"> Favoritos</span>
                      <span class="badge" id="fav_<?php echo $dt['idpublicacion']?>"><?php echo $fav;?></span>
                      </a></li>
                      
                      <?php
					  	$com_p = mysql_query("SELECT * FROM comentarios WHERE publicaciones_idpublicacion = '$dt[idpublicacion]'") or die(mysql_error());
						$com = mysql_num_rows($com_p);
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
	<div class='well-bl-2 visible-xs visible-sm'><div class='row'><div class='col-xs-12'><?php publicidad() ?>"</div></div></div>
		<div class='row'>
    		<div class='col-xs-12'>
    			<div class='text-center'>
					<ul class='pagination pagination-lg'><?php
                      if ($count != 0) {
                      	if ($get == 0) {
						  echo "<li class='disabled'><a>&laquo; <span class='hidden-xs'>Anterior</span></a></li>";
						 } else {
						  echo "<li><a href='".$link."=".($get-1)."'>&laquo;<span class='hidden-xs'>Anterior</span></a></li>";
						 }
						 
					# Si get == 0
                      if ($get == 0) {
						echo "<li class='active'><a href=".$link."=".($get).">".($get)."</a></li>";
						if ($get + 1 >= $count) { 
						   echo "<li class='disabled'><a>".($get+1)."</a></li>";
						    } else {
							   echo "<li><a href=".$link."=".($get+1).">".($get +1)."</a></li>";
							    } 
                      	if ($get + 2 >= $count) { 
						   echo "<li class='disabled'><a>".($get+2)."</a></li>";
						    } else {
							   echo "<li><a href=".$link."=".($get+2).">".($get +2)."</a></li>";
							    } 
						if ($get + 3 >= $count) { 
						   echo "<li class='disabled'><a>".($get+3)."</a></li>";
						    } else {
							   echo "<li><a href=".$link."=".($get+3).">".($get +3)."</a></li>";
							    } 
						if ($get + 4 >= $count) { 
						   echo "<li class='disabled'><a>".($get+4)."</a></li>";
						    } else {
							   echo "<li><a href=".$link."=".($get+4).">".($get +4)."</a></li>";
							    } 
								
					  # SI GET = 1
					  } else if ($get == 1) {
						echo "<li><a href=".$link."=".($get-1).">".($get -1)."</a></li>"; 
						echo "<li class='active'><a href=".$link."=".($get).">".($get)."</a></li>";
						if ($get + 1 >= $count) { 
						   echo "<li class='disabled'><a>".($get+1)."</a></li>";
						    } else {
							   echo "<li><a href=".$link."=".($get+1).">".($get +1)."</a></li>";
							    } 
                      	if ($get + 2 >= $count) { 
						   echo "<li class='disabled'><a>".($get+2)."</a></li>";
						    } else {
							   echo "<li><a href=".$link."=".($get+2).">".($get +2)."</a></li>";
							    }
						if ($get + 3 >= $count) { 
						   echo "<li class='disabled'><a>".($get+3)."</a></li>";
						    } else {
							   echo "<li><a href=".$link."=".($get+3).">".($get +3)."</a></li>";
							    } 
                       		 
					   
						#Si get > 1
					  } else {
						echo "<li><a href=".$link."=".($get-2).">".($get -2)."</a></li>";
						echo "<li><a href=".$link."=".($get-1).">".($get -1)."</a></li>"; 
						echo "<li class='active'><a href=".$link."=".($get).">".($get)."</a></li>";
						if ($get + 1 >= $count) { 
						   echo "<li class='disabled'><a>".($get+1)."</a></li>";
						    } else {
							   echo "<li><a href=".$link."=".($get+1).">".($get +1)."</a></li>";
							    } 
                      	if ($get + 2 >= $count) { 
						   echo "<li class='disabled'><a>".($get+2)."</a></li>";
						    } else {
							   echo "<li><a href=".$link."=".($get+2).">".($get +2)."</a></li>";
							    }
					  }
						if($get+1 >= $count) {
						  echo "<li class='disabled'><a><span class='hidden-xs'>Siguiente</span> &raquo;</a></li>";
						  } else {
						  echo "<li><a href='".$link."=".($get+1)."><span class='hidden-xs'>Siguiente</span> &raquo;</a></li>";
							}
					#No hay nada esto pasa cuando count vale 0!
					  } else {
						  }
		?></ul></div></div></div><?php
		
	} else {
		header("Location: ?p=404");
		}
	}
