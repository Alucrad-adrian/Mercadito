
<h1>Lista de productos</h1>
<a href="<?php echo base_url(); ?>index.php/producto/agregar">
<button type="button" class="btn btn-primary">Agregar producto</button>
</a>
<table>
    <tr>
        <th>ID</th>
        <th>Propietario</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Categoría</th>
        <th>Habilitado</th>
        <th>Imagen</th>
        <th>Modificar</th>
        <th>Eliminar</th>
        <th>Deshabilitar</th>
    </tr>
    <?php foreach($productos->result() as $producto): ?>
    <tr>
        <td><?php echo $producto->idProducto; ?></td>
        <td><?php echo $producto->propietario; ?></td>
        <td><?php echo $producto->nombre_producto; ?></td>
        <td><?php echo $producto->descripcion; ?></td>
        <td><?php echo $producto->precio_unitario; ?></td>
        <td><?php echo $producto->categoria; ?></td>
        <td><?php echo $producto->habilitado ? 'Sí' : 'No'; ?></td>
        <td><img src="<?php echo base_url('uploads/productos/'.$producto->imagen); ?>" alt="Imagen del producto" width="50"></td>
            <td>
            <form action="<?php echo base_url('index.php/producto/modificar'); ?>" method="post">
                <input type="hidden" name="idProducto" value="<?php echo $producto->idProducto; ?>">
                <button type="submit" class="btn btn-success">Modificar</button>
            </form>
            </td>
            <td>
            <form action="<?php echo base_url('index.php/producto/eliminarbd'); ?>" method="post">
                <input type="hidden" name="idProducto" value="<?php echo $producto->idProducto; ?>">
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
            </td>
            <td><form action="<?php echo base_url('index.php/producto/'.($producto->habilitado ? 'deshabilitarbd' : 'habilitarbd')); ?>" method="post">
                <input type="hidden" name="idProducto" value="<?php echo $producto->idProducto; ?>">
                <button type="submit" class="btn btn-warning"><?php echo $producto->habilitado ? 'Deshabilitar' : 'Habilitar'; ?></button>
            </form></td>
    </tr>
    <?php endforeach; ?>
</table>
