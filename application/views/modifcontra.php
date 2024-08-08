<h1>Modificar Contraseña</h1>
<br>

<?php
foreach($infousuario->result() as $row)
{
?>
<?php
echo form_open_multipart("estudiante/modificarPassword");
?>
<input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">

<div class="form-group">
    <label for="passwordActual">Contraseña Actual</label>
    <input type="password" class="form-control" name="passwordActual" placeholder="Escribe la contraseña actual" required>
</div>

<div class="form-group">
    <label for="nuevaPassword">Nueva Contraseña</label>
    <input type="password" class="form-control" name="nuevaPassword" placeholder="Escribe la nueva contraseña" minlength="6" required>
</div>

<div class="form-group">
    <label for="confirmarPassword">Confirmar Nueva Contraseña</label>
    <input type="password" class="form-control" name="confirmarPassword" placeholder="Confirma la nueva contraseña" minlength="6" required>
</div>

<button type="submit" class="btn btn-success">Modificar Contraseña</button>

<?php
echo form_close();
}
?>
