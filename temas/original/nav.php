<nav>
	<div id="nav-superior-espacio">
    </div>
            <button id="nav-content" onClick="window.location.href='?<?php echo $prop['nombre'];?>=principal'">
                <div id="nav-content-image">
                	<img src="static-content/nav/inicio.png">
                </div>
                <div id="nav-content-text">
					Inicio
               	</div>
            </button>
            <button id="nav-content" onClick="window.location.href='?<?php echo $prop['nombre'];?>=principal&amp;page=explora'">
                <div id="nav-content-image">
                	<img src="static-content/nav/inicio.png">
                </div>
                <div id="nav-content-text">
					Explora
               	</div>
            </button>
            <div id="nav-hr"></div>
            <?php if(!isset($_SESSION['username'])) { 
			
			/* 
				No existe sesion
			*/
			?>
            <button id="nav-content" onClick="window.location.href='?<?php echo $prop['nombre'];?>=principal&amp;page=registro'">
                <div id="nav-content-image">
                	<img src="static-content/nav/inicio.png">
                </div>
                <div id="nav-content-text">
					Regístrate
               	</div>
            </button>
            <?php 
			
			/*
           		Iniciada sesion
            */ 
		 	} else { ?>
            <button id="nav-content" onClick="window.location.href='?<?php echo $prop['nombre'];?>=usuario&amp;page=enviar_publicacion'">
                <div id="nav-content-image">
                	<img src="static-content/nav/inicio.png">
                </div>
                <div id="nav-content-text">
					Publica
               	</div>
            </button>
			<?php } ?>
    </div>
<section>