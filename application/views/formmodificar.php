<br><br>
<h1>Modificar usuario</h1>
<br>

<?php
foreach($infousuario->result() as $row)
{
?>
<?php
echo form_open_multipart("estudiante/modificarbd");
?>
<input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">

<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre" placeholder="Escribe nombre" value="<?php echo $row->nombre; ?>" required>
</div>

<div class="form-group">
    <label for="apellido1">Apellido Paterno</label>
    <input type="text" class="form-control" name="apellido1" placeholder="Escribe apellido paterno" minlength="3" maxlength="20" value="<?php echo $row->apellido1; ?>" required>
</div>

<div class="form-group">
    <label for="apellido2">Apellido Materno</label>
    <input type="text" class="form-control" name="apellido2" placeholder="Escribe apellido materno" value="<?php echo $row->apellido2; ?>" required>
</div>

<div class="form-group">
    <label for="rol">Rol</label>
    <input type="text" class="form-control" name="rol" placeholder="Escribe rol" value="<?php echo $row->rol; ?>" required>
</div>

<div class="form-group">
    <label for="correo">Correo</label>
    <input type="email" class="form-control" name="correo" placeholder="Escribe correo" value="<?php echo $row->correo; ?>" required>
</div>

<div class="form-group">
    <label for="carnet">Carnet</label>
    <input type="text" class="form-control" name="carnet" placeholder="Escribe carnet" value="<?php echo $row->carnet; ?>" required>
</div>

<div class="form-group">
    <label for="celular">Celular</label>
    <input type="text" class="form-control" name="celular" placeholder="Escribe celular" value="<?php echo $row->celular; ?>" required>
</div>

<button type="submit" class="btn btn-success">Modificar usuario</button>
	
<?php
echo form_close();
}
?>
