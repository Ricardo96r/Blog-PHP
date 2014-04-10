<nav>
	<div id="nav-superior-espacio">
    </div>
    <div id="nav-content">
        <ul>
        	<a href="?<?php echo $prop['nombre'];?>=principal">
            	<div>
                <div id="header-content-image">
                	<img src="static-content/nav/inicio.png">
                </div>
                <div id="header-content-image">
            		Inicio
                </div>
            	</div>
            </a>
       	    <a href="?<?php echo $prop['nombre'];?>=principal&amp;page=explora"><div>Explora</div></a>
            <?php if(!isset($_SESSION['username'])) { ?>
                <a href="?<?php echo $prop['nombre'];?>=principal&amp;page=registro"><div>Regístrate</div></a>
            <?php } else { ?>
                    <a href="?<?php echo $prop['nombre'];?>=usuario&amp;page=enviar_publicacion"><div>Publica</div></a>
                    <?php 
                }
                ?>
        </ul>
    </div>
</nav>
<section>