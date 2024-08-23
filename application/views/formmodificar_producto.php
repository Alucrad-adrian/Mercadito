<h1>Modificar producto</h1>
<?php
foreach ($producto->result() as $row) {
    echo form_open_multipart("producto/modificarbd");
?>
<input type="hidden" name="idProducto" value="<?php echo $row->idProducto; ?>">
<input type="hidden" name="imagen_actual" value="<?php echo $row->imagen; ?>"> <!-- Campo oculto para la imagen actual -->
<div class="form-group">
    <label for="propietario">Propietario</label>
    <input type="text" class="form-control" name="propietario" value="<?php echo $row->propietario; ?>" required>
</div>
<div class="form-group">
    <label for="nombre_producto">Nombre</label>
    <input type="text" class="form-control" name="nombre_producto" value="<?php echo $row->nombre_producto; ?>" required>
</div>
<div class="form-group">
    <label for="descripcion">Descripción</label>
    <textarea class="form-control" name="descripcion" required><?php echo $row->descripcion; ?></textarea>
</div>
<div class="form-group">
    <label for="precio_unitario">Precio Unitario</label>
    <input type="number" class="form-control" name="precio_unitario" value="<?php echo $row->precio_unitario; ?>" required>
</div>
<div class="form-group">
    <label for="categoria">Categoría</label>
    <input type="text" class="form-control" name="categoria" value="<?php echo $row->categoria; ?>" required>
</div>
<div class="form-group">
    <label for="habilitado">Habilitado</label>
    <select class="form-control" name="habilitado" required>
        <option value="1" <?php echo $row->habilitado ? 'selected' : ''; ?>>Sí</option>
        <option value="0" <?php echo !$row->habilitado ? 'selected' : ''; ?>>No</option>
    </select>
</div>
<div class="form-group">
    <label for="imagen">Imagen</label>
    <input type="file" class="form-control" name="imagen">
    <br>
    <!-- Muestra la imagen actual -->
    <?php if ($row->imagen): ?>
        <img src="<?php echo base_url('uploads/productos/' . $row->imagen); ?>" alt="Imagen actual" width="150">
    <?php else: ?>
        <p>No hay imagen cargada.</p>
    <?php endif; ?>
</div>
<button type="submit" class="btn btn-success">Modificar producto</button>
<?php echo form_close(); ?>
<?php
}
?>
