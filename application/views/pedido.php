<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: lightskyblue;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Mercadito Friki</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reserva</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="row">
                <div class="col-12">
                    <!-- Muestra los datos de $producto para verificar -->
                    <div class="container">
                        <h2>Confirmar Reserva</h2>

                        <?php if (isset($producto)): ?>
                            <label for="Producto">Producto:</label><br><?php echo $producto->nombre_producto; ?>
                            <br>
                            <label for="Precio unitario">Precio unitario:</label><br><?php echo $producto->precio_unitario; ?> Bs
                            <br>
                            <label for="propietarioProducto">Propietario:</label><br><?php echo $producto->propietario; ?>
                            <!-- Campo para seleccionar cantidad -->
                            <div class="form-group">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" value="1" onchange="actualizarTotal(<?php echo $producto->precio_unitario; ?>)">
                            </div>
                            <label for="idpuesto">ID del Puesto: 
                            <?php 
                            // Aquí se asume que el puestoProducto se envió como parte de la solicitud
                            echo isset($puestoProducto) ? $puestoProducto : 'no existe'; 
                            ?>

                            <!-- Mostrar el precio total -->
                            <p>Total: <span id="total"><?php echo $producto->precio_unitario; ?></span> Bs</p>

                            <!-- Formulario para confirmar la reserva -->
                            <form action="<?php echo base_url('index.php/pedido/confirmarReserva'); ?>" method="post">
                                
                                <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>"> <!-- Campo para el ID del usuario -->
                                <input type="hidden" name="productoId" value="<?php echo $producto->idProducto; ?>">
                                <input type="hidden" id="precio_unitario" name="precio_unitario" value="<?php echo $producto->precio_unitario; ?>">
                                <input type="hidden" id="precio_total" name="precio_total" value="<?php echo $producto->precio_unitario; ?>">
                                <input type="hidden" name="propietarioProducto" value="<?php echo $producto->propietario; ?>">
                                <input type="hidden" id="puestoProducto" name="puestoProducto" value="<?php echo isset($puestoProducto) ? $puestoProducto : 'no existe'; ?>">
                                <input type="hidden" id="cantidadSeleccionada" name="cantidadSeleccionada" value="1">
                                <button type="submit" class="btn btn-success">Confirmar Reserva</button>
                            </form>

                            <!-- Botón de Cancelar -->
                            <a href="<?php echo base_url('index.php/usuarios/ventanaCliente'); ?>" class="btn btn-danger">Cancelar</a>

                        <?php else: ?>
                            <p>Error: Producto no encontrado.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
</div><!-- /.content-wrapper -->

<!-- Script para actualizar el precio total en función de la cantidad seleccionada -->
<script>
function actualizarTotal(precioUnitario) {
    var cantidad = document.getElementById('cantidad').value;
    var total = precioUnitario * cantidad;

    // Actualizar el precio total en la vista
    document.getElementById('total').innerText = total;

    // Actualizar los campos ocultos del formulario
    document.getElementById('precio_total').value = total;
    document.getElementById('cantidadSeleccionada').value = cantidad;
}
</script>
