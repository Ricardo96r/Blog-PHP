<?php
if(!isset($indexphp) and $indexphp !== TRUE) {
	header('Location: /index.php');
	exit;
}
?>
</div>
<div class="col-md-4 aside visible-md visible-lg">
<div class="row">
<?php 
if ($page != 'perfil') {?>
	<div class="affix-aside" data-spy="affix" data-offset-top="10" style="width:320px;">
<?php } else {?>
	<div class="affix-aside-perfil" data-spy="affix" data-offset-top="400" style="width:320px;">
	<?php }?>
	<div class="col-xs-12 col-sm-6 col-md-12 well-bl-1">
    <?php publicidad(); ?>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-12 well-bl-1">
    <?php publicidad(); ?>
	</div>
    </div>
</div>
</div>
</div>
</div>
</div>