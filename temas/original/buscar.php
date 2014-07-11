<?php if (isset($_SESSION['username'])) {?>
<div class="well-bl-form">
    <div class="page-header">
        <h1>Buscar</h1>
    </div>
    <form method="post">
        <div class="form-group registro-form-contraseña1-input">
            <input class="form-control" type="text" name="contraseña" id="registro-form-contraseña1-input" maxlength="30" placeholder="buscar" required>
        </div>
        <div class="form-group">
            <button class="btn btn-warning form-control registro-submit" id="registro-submit">Realizar busqueda</button>
        </div>
    </form>
</div>
<?php } else {
	header ('Location: ?p=404');
	}