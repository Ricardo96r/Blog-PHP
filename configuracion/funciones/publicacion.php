<?php
function post ($dt) {
	global $prop, $db, $pf;
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
                    <strong><?php echo $dt['nombre'].'' ?></a></strong>
                    <small><a class="a-clear" href="?p=perfil&pf=<?php echo $dt['cuenta'];?>"><?php echo ' - @'.$dt['cuenta'].'' ?></a></small>    
                    </div>
                    <span class="time" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $dt['tiempo_de_creacion'];?>">
                    <?php echo '<small>'.tiempo_transcurrido($dt['tiempo_de_creacion']).'</small>';?>
                    </span>
                    <strong class="text-success"> +<?php echo $dt['puntos'];?></strong>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="pb-pb center-block">
                    <a class='a-clear' href='?pb=<?php echo $dt['idpublicacion']; ?>'>
                    	<blockquote><p><?php echo $dt['publicacion']; ?></p></blockquote>
                        <?php echo '<img class=image-md center-block src=static-content/publicaciones/'.$dt['ruta'].'>'; ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="pb-bottom">
                    <ul class="nav nav-pills">
                    <?php
					#ME GUSTA
					if ($mg_p = $db->query("SELECT * FROM publicaciones_megusta WHERE publicaciones_idpublicacion = '".$dt['idpublicacion']."'")) {
						$mg = $mg_p->num_rows;
					}
					if (isset($_SESSION['username'])) {
						if ($ismg_p = $db->query("SELECT cuentas_idcuenta, publicaciones_idpublicacion FROM publicaciones_megusta WHERE cuentas_idcuenta = ".$pf['idcuenta']." and publicaciones_idpublicacion = ".$dt['idpublicacion'])) {
							$ismg = $ismg_p->num_rows;
							}
					} else {
						$ismg = 0;
						}
					if (isset($_SESSION['username'])) {
					?>
                        <li class="nav-pills-space resultado_<?php echo $dt['idpublicacion']?> <?php if($ismg > 0){echo "active";}?>"
                        onclick="me_gusta_<?php echo $dt['idpublicacion']?>(<?php echo $dt['idpublicacion']; ?>);return false;"><a  href="">
                        <span class="glyphicon glyphicon-thumbs-up"></span><span class="hidden-xs"> Me gusta</span>
                        <span class="badge" id="resultado_<?php echo $dt['idpublicacion']?>"><?php echo $mg;?></span>
                        </a></li>
                    <?php
					} else { ?>
                        <li class="nav-pills-space"><a href="?p=login">
                        <span class="glyphicon glyphicon-thumbs-up"></span><span class="hidden-xs"> Me gusta</span>
                        <span class="badge"><?php echo $mg;?></span>
                        </a></li>
					<?php }?>
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
                                            $(".resultado_<?php echo $dt['idpublicacion']?>").toggleClass("active");
                                            $("#resultado_<?php echo $dt['idpublicacion']?>").html(response);
                                    }
                            });
                    }
                    </script>
					<?php
					# FAVORITOS
					if ($fav_p = $db->query("SELECT * FROM publicaciones_favoritos WHERE publicaciones_idpublicacion = '".$dt['idpublicacion']."'")) {
						$fav = $fav_p->num_rows;
					}
					if (isset($_SESSION['username'])) {
						if ($isfav_p = $db->query("SELECT cuentas_idcuenta, publicaciones_idpublicacion FROM publicaciones_favoritos WHERE cuentas_idcuenta = ".$pf['idcuenta']." and publicaciones_idpublicacion = ".$dt['idpublicacion'])) {
							$isfav = $isfav_p->num_rows;
							}
					} else {
						$isfav = 0;
						}
					if(isset($_SESSION['username'])) {
					?>
                        <li class="nav-pills-space fav_<?php echo $dt['idpublicacion']?> <?php if($isfav > 0){echo "active";}?>"
                        onclick="favoritos_<?php echo $dt['idpublicacion']?>(<?php echo $dt['idpublicacion']; ?>);return false;"><a href="">
                        <span class="glyphicon glyphicon-star"></span><span class="hidden-xs"> Favoritos</span>
                        <span class="badge" id="fav_<?php echo $dt['idpublicacion']?>"><?php echo $fav;?></span>
                        </a></li>
                    <?php } else {?>
                        <li class="nav-pills-space"><a href="?p=login">
                        <span class="glyphicon glyphicon-star"></span><span class="hidden-xs"> Favoritos</span>
                        <span class="badge"><?php echo $fav;?></span>
                        </a></li>
                    <?php } ?>
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
                                        $(".fav_<?php echo $dt['idpublicacion']?>").toggleClass("active");
                                        $("#fav_<?php echo $dt['idpublicacion']?>").html(response);
                                    }
                            });
                    }
                    </script>
                    <?php
                    if ($com_p = $db->query("SELECT * FROM comentarios WHERE publicaciones_idpublicacion = '".$dt['idpublicacion']."'")) {
                        $com = $com_p->num_rows;
                    }
                    ?>
                    <li><a href="?pb=<?php echo $dt['idpublicacion']; ?>">
                    <span class="glyphicon glyphicon-comment"></span><span class="hidden-xs"></span>
                    <span class="badge"><?php echo $com;?></span>
                    </a></li>
                  
                    <li class="dropup pull-right">
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