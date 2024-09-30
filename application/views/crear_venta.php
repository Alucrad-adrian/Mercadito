<h1>Crear Venta</h1>

<?php echo validation_errors(); ?>

<?php echo form_open('venta/crear'); ?>

    <label for="cliente_id">Cliente:</label>
    <input type="text" name="cliente_id"><br>

    <label for="productos[]">Productos:</label>
    <!-- Aquí puedes iterar sobre una lista de productos -->
    <select name="productos[]">
        <?php foreach ($productos as $producto): ?>
            <option value="<?= $producto->idproducto ?>">
                <?= $producto->nombre_producto ?> - <?= $producto->precio_unitario ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="cantidad">Cantidad:</label>
    <input type="number" name="cantidad" min="1" value="1"><br>

    <label for="monto_total">Monto Total:</label>
    <input type="text" name="monto_total" readonly><br>

    <button type="submit">Crear Venta</button>

<?php echo form_close(); ?>
