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
			<select name=\"mes\" class=\"form-control\">
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
		echo "<select name=\"dia\" class=\"form-control\">";
		echo "<option value=\"day\">Día</option>";
		$maxdy = 31;
		for ($i = 1; $i <= $maxdy; $i++)
		{
			echo "<option value=\"$i\">$i</option>";
		}
		echo "</select>";
	}
	if ($type == 'año') {
		echo "<select name=\"año\" class=\"form-control\">";
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
				<?php echo $dt['nombres']." ".$dt['apellidos']."" ?></a>
                <a class="a-clear" href="?p=perfil&pf=<?php echo $dt['cuenta'];?>"><?php echo " - @".$dt['cuenta']."" ?></a>     
               
                <div>
                <?php echo "<small>".$dt['tiempo_de_creacion']."</small>" ?>
                </div>
                </div>
            </div>
        </div>
			<div class="row">
                <div class="col-xs-12">
                    <div class="pb-pb">
                    <?php if (!isset($dt['idcomentario'])) {?>
                        <a class='a-clear' href='?id=<?php echo $dt['idpublicacion']; ?>'>
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
                              <li><a href="#">Me gusta<span class="badge hidden-xs">423</span></a></li>
                              <li><a href="#">Favoritos<span class="badge hidden-xs">423</span></a></li>
                                <li class="dropup  pull-right">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                      Compartir <span class="caret"></span>
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

?>