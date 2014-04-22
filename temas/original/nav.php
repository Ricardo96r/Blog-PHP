<nav>
	<div id="nav-superior-espacio">
    </div>
            <button class="nav-content"
            <?php 
			if ($page == "") {
            	echo "id='nav-content-stay'";
			} else {
				echo "";
				}
            ?>
            onClick="window.location.href='.'">
                <div id="nav-content-image">
                	<img src="temas/<?php echo $prop['tema'];?>/imagenes/inicio.png">
                </div>
                <div id="nav-content-text">
					Inicio
               	</div>
            </button>
            <button class="nav-content" 
            <?php 
			if ($page == "explorar") {
				echo "id='nav-content-stay'";
			} else {
				echo "";
				}
            ?>
            onClick="window.location.href='?p=explora'">
                <div id="nav-content-image">
                	<img src="temas/<?php echo $prop['tema'];?>/imagenes/inicio.png">
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
            <button class="nav-content" 
            <?php 
				if ($page == "registro") {
					echo "id='nav-content-stay'";
				} else {
					echo "";
					}
            ?>
            onClick="window.location.href='?p=registro'">
                <div id="nav-content-image">
                	<img src="temas/<?php echo $prop['tema'];?>/imagenes/inicio.png">
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
            <button class="nav-content" 
             <?php 
			if ($page == "publicar") {
				echo "id='nav-content-stay'";
			} else {
				echo "";
				}
            ?>
            onClick="window.location.href='?p=publicar'">
                <div id="nav-content-image">
                	<img src="temas/<?php echo $prop['tema'];?>/imagenes/inicio.png">
                </div>
                <div id="nav-content-text">
					Publica
               	</div>
            </button>
			<?php } ?>
    </div>
<section>