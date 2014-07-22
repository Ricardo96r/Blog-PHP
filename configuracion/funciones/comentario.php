<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
function comentario ($dt) {
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
                    <?php echo $dt['nombre'].'' ?></a>
                    <a class="a-clear" href="?p=perfil&pf=<?php echo $dt['cuenta'];?>"><?php echo " - @".$dt['cuenta'].'' ?></a>     
                    </div>
                    
                    <span class="time" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo $dt['tiempo_de_creacion'];?>">
                    <?php echo '<small>'.tiempo_transcurrido($dt['tiempo_de_creacion']).'</small>';?>
                    </span>
                	<strong class="text-success"> +<?php echo $dt['puntos'];?></strong>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="pb-pb center-block">
                	<blockquote><p><?php echo $dt['comentario']; ?></p></blockquote>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="pb-bottom">
                    <ul class="nav nav-pills"><?php
					
					/*
					-------------------
					ME GUSTA
					-------------------
					*/
					if ($mg_p = $db->query("SELECT * FROM comentarios_megusta WHERE comentarios_idcomentario = '".$dt['idcomentario']."'")) {
						$mg = $mg_p->num_rows;
					}
					if (rango() >= 1) {
						if ($ismg_p = $db->query("SELECT cuentas_idcuenta, comentarios_idcomentario FROM comentarios_megusta WHERE cuentas_idcuenta = ".$pf['idcuenta']." and comentarios_idcomentario = ".$dt['idcomentario'])) {
							$ismg = $ismg_p->num_rows;
							}
					} else {
						$ismg = 0;
						}
					if (rango() >= 1) {
					?>
                        <li class="nav-pills-space resultado_<?php echo $dt['idcomentario']?> <?php if($ismg > 0){echo "active";}?>"
                        onclick="comentarios_megusta_<?php echo $dt['idcomentario']?>(<?php echo $dt['idcomentario']; ?>);return false;"><a  href="">
                        <span class="glyphicon glyphicon-thumbs-up"></span><span class="hidden-xs"> Me gusta</span>
                        <span class="badge" id="resultado_<?php echo $dt['idcomentario']?>"><?php echo $mg;?></span>
                        </a></li>
                    <?php
					} else { ?>
                        <li class="nav-pills-space"><a href="?p=login">
                        <span class="glyphicon glyphicon-thumbs-up"></span><span class="hidden-xs"> Me gusta</span>
                        <span class="badge"><?php echo $mg;?></span>
                        </a></li>
					<?php }?>
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
                                        new Spinner(opts).spin(document.getElementById('resultado_<?php echo $dt['idcomentario']?>'))
                                            
                                    },
                                    success:  function (response) {
                                            $(".resultado_<?php echo $dt['idcomentario']?>").toggleClass("active");
                                            $("#resultado_<?php echo $dt['idcomentario']?>").html(response);
                                    }
                            });
                    }
                    </script>
                    
					<?php  
                    /*
					-------------------
					FAVORITOS
					-------------------
					*/
                    if ($fav_p = $db->query("SELECT * FROM comentarios_favoritos WHERE comentarios_idcomentario = '".$dt['idcomentario']."'")) {
						$fav = $fav_p->num_rows;
					}
					if (rango() >= 1) {
						if ($isfav_p = $db->query("SELECT cuentas_idcuenta, comentarios_idcomentario FROM comentarios_favoritos WHERE cuentas_idcuenta = ".$pf['idcuenta']." and comentarios_idcomentario = ".$dt['idcomentario'])) {
							$isfav = $isfav_p->num_rows;
							}
					} else {
						$isfav = 0;
						}
					if(rango() >= 1) {
					?>
                        <li class="nav-pills-space com_fav_<?php echo $dt['idcomentario']?> <?php if($isfav > 0){echo "active";}?>"
                        onclick="comentarios_favoritos_<?php echo $dt['idcomentario']?>(<?php echo $dt['idcomentario']; ?>);return false;"><a href="">
                        <span class="glyphicon glyphicon-star"></span><span class="hidden-xs"> Favoritos</span>
                        <span class="badge" id="com_fav_<?php echo $dt['idcomentario']?>"><?php echo $fav;?></span>
                        </a></li>
                    <?php } else {?>
                        <li class="nav-pills-space"><a href="?p=login">
                        <span class="glyphicon glyphicon-star"></span><span class="hidden-xs"> Favoritos</span>
                        <span class="badge"><?php echo $fav;?></span>
                        </a></li>
                    <?php } ?>
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
                                        new Spinner(opts).spin(document.getElementById('com_fav_<?php echo $dt['idcomentario']?>'));
                                    },
                                    success:  function (response) {
                                        $(".com_fav_<?php echo $dt['idcomentario']?>").toggleClass("active");
                                        $("#com_fav_<?php echo $dt['idcomentario']?>").html(response);
                                    }
                            });
                    }
                    </script>
                      
                      
                      
                      
                      
                      
                      
                      <?php
					  	if ($com_p = $db->query("SELECT * FROM subcomentarios WHERE comentarios_idcomentario = '".$dt['idcomentario']."'")) {
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