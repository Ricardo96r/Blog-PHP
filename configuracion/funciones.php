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
			<select name=\"mes\" id=\"registro-form-nacimiento-select\">
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
		echo "<select name=\"dia\" id=\"registro-form-nacimiento-select\">";
		echo "<option value=\"day\">Día</option>";
		$maxdy = 31;
		for ($i = 1; $i <= $maxdy; $i++)
		{
			echo "<option value=\"$i\">$i</option>";
		}
		echo "</select>";
	}
	if ($type == 'año') {
		echo "<select name=\"año\" id=\"registro-form-nacimiento-select\">";
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
    <article id="contenido-contenedor">
    	<div id="contenido">
			<div id="contenido_arriba">
            	<div id="contenido_arriba_imagen-perfil">
                	<img src="static-content/perfiles/<?php echo $dt['imagen_perfil']?>">
                </div>
				<div id='contenido_arriba_nombre'>
					<a href="?p=perfil&pf=<?php echo $dt['cuenta'];?>">
						<?php echo $dt['nombres']." ".$dt['apellidos']." <br>@".$dt['cuenta']; ?>
                    </a>
				</div>
				<div id='contenido_arriba_fecha'>
					<?php echo $dt['tiempo_de_creacion']; ?>
				</div>
			</div>
			<div id='contenido_central'>
            <?php if (!isset($dt['idcomentario'])) {?>
				<a href='?id=<?php echo $dt['idpublicacion']; ?>'>
					<?php echo $dt['publicacion']; ?>
				</a>
            <?php } else {?>
					<?php echo $dt['comentario']; ?>
            <?php } ?>
			</div>
			<div id='contenido_abajo' >
                    <div id="contenido_abajo_megusta">
                    	<button id="contenido_abajo_megusta_boton">
                        	<div>Me gusta</div>
                        	<div></div>
                       	</button>
                    </div>
                    <div id="contenido_abajo_favoritos">
                    	<button id="contenido_abajo_favoritos_boton">
                    		<div>A favoritos</div>
                        	<div></div>
                        </button>
                    </div>
                    <div id="contenido_abajo_guardar">
                        <button id="contenido_abajo_guardar_boton">
                            <div>Guardar</div>
                            <div></div>
                        </button>
                    </div>
            </div>
        </div>
	</article>
<?php } 

?>