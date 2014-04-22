
<?php
if (isset($_GET['pf'])) {
	$perfil_get= antiSqlInjection($_GET['pf']);
  	$perfil_op = mysql_query("
		SELECT idcuenta, cuenta, email, nombres, apellidos, nacimiento, sexo, imagen_perfil, imagen_perfil_fondo
		FROM cuentas WHERE cuenta = '$perfil_get'"
		, $conn) or die (mysql_error());
	$perfil = mysql_fetch_array($perfil_op);
} else {
   // REVISAR
}

if (!isset($perfil) or !isset($perfil_get) or empty($perfil) or empty($perfil_get)) {
	header("Location: ?$prop[nombre]=principal");
	} else {
		if($perfil == !NULL) { 
		$perfil_notas = mysql_query("
			SELECT cuentas.idcuenta, cuentas.cuenta, cuentas.nombres, cuentas.apellidos, cuentas.imagen_perfil, cuentas.imagen_perfil_fondo, publicaciones.idpublicacion, publicaciones.publicacion, publicaciones.tiempo_de_creacion 
			FROM publicaciones
			INNER JOIN cuentas
			ON cuentas.idcuenta = publicaciones.cuentas_idcuenta
			WHERE cuentas.cuenta = '$perfil[cuenta]'
			ORDER BY `idpublicacion` DESC", $conn) or die(mysql_error());?>
        <div class="fondo" id="perfil-contenedor" style="background:#FF8F32;">
        	<div id="perfil-fondo-imagen_perfil">
            	<img src="static-content/perfiles/<?php echo $perfil['imagen_perfil']?>">
            </div>
            <div id="perfil-fondo-contenido_fondo">
            	<div id="perfil-fondo-contenido">
					<div id="perfil-fondo-contenido-nombre">
                    	<span>
						<?php echo $perfil['nombres']." ".$perfil['apellidos'];?>
                        </span>
                    </div>
                    <div id="perfil-fondo-contenido-cuenta">
                   		<span>
                    	<?php echo "@".$perfil['cuenta']; ?>
                        </span>
                    </div>
                </div>
           	</div>
                <div id="perfil-fondo-contenido-datos">
                    <div id="perfil-fondo-contenido-datos_seguidores">
                    	<button id="perfil-fondo-contenido-datos_seguidores_boton">
                        	<div>Seguidores</div>
                        	<div><?php echo mysql_num_rows($perfil_notas);?></div>
                       	</button>
                    </div>
                    <div id="perfil-fondo-contenido-datos_siguiendo">
                    	<button id="perfil-fondo-contenido-datos_siguiendo_boton">
                    		<div>Siguiendo</div>
                        	<div><?php echo mysql_num_rows($perfil_notas);?></div>
                        </button>
                    </div>
                    <div id="perfil-fondo-contenido-datos_publicaciones">
                        <button id="perfil-fondo-contenido-datos_publicaciones_boton">
                            <div>Publicaciones</div>
                            <div><?php echo mysql_num_rows($perfil_notas);?></div>
                        </button>
                    </div>
                </div>
        </div>
		<?php			
		while ($nts = mysql_fetch_array($perfil_notas)) {
			post($nts);
			}
		} else {
			header("Location: ?$prop[nombre]=principal");
			}
		}
?>
