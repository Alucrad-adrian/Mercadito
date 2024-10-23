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
                    <!-- Muestra los productos disponibles para reservar -->
                    <div class="container">
                        <h2>Reservar productos</h2>
                        <select id="propietario" class="form-control" onchange="filtrarProductos()">
                    <option value="">Todas las tiendas</option>
                    <option value="pseudogente">pseudogente</option>
                    <option value="Z-store">Z-store</option>
                    <?php foreach ($propietarios as $propietario): ?>
                        <option value="<?php echo $propietario->propietario; ?>"><?php echo $propietario->propietario; ?></option>
                    <?php endforeach; ?>
                </select>

                        <!-- Formulario para reservar varios productos -->
                        <form action="<?php echo base_url('reserva/crear_reserva'); ?>" method="post">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th>Cantidad</th>
                                        <th>Seleccionar</th>
                                    </tr>
                                </thead>
                                <tbody>
    <?php foreach ($productos as $producto): ?> <!-- Usar directamente el array sin 'result()' -->
    <tr>
        <td><?php echo $producto['nombre_producto']; ?></td>
        <td><?php echo $producto['descripcion']; ?></td>
        <td><?php echo $producto['precio_unitario']; ?> Bs.</td>
        <td><?php echo $producto['stock']; ?></td>
        <td>
            <input type="number" name="cantidad[<?php echo $producto['idProducto']; ?>]" min="1" max="<?php echo $producto['stock']; ?>">
        </td>
        <td>
            <input type="checkbox" name="productos_seleccionados[]" value="<?php echo $producto['idProducto']; ?>">
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>

                            </table>

                            <!-- Total dinámico -->
                            <p>Total: <span id="total">0</span> Bs.</p>

                            <!-- Campo oculto para el ID del puesto -->
                            <input type="hidden" name="idpuesto" value="<?php echo $idPuesto; ?>">

                            <!-- Botón de Confirmar Reserva -->
                            <button type="submit" class="btn btn-primary">Reservar productos</button>
                        </form>

                        <!-- Botón de Cancelar -->
                        <a href="<?php echo base_url('index.php/usuarios/ventanaCliente'); ?>" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
</div><!-- /.content-wrapper -->

<!-- Script para actualizar el precio total en función de los productos seleccionados y sus cantidades -->
<script>
    const checkboxes = document.querySelectorAll('.producto-checkbox');
    const cantidadInputs = document.querySelectorAll('.cantidad');
    const totalElement = document.getElementById('total');

    // Actualiza el total cuando se cambia la selección o cantidad de productos
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', actualizarTotal);
    });

    cantidadInputs.forEach(input => {
        input.addEventListener('input', actualizarTotal);
    });

    function actualizarTotal() {
        let total = 0;
        
        checkboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                const cantidad = parseFloat(cantidadInputs[index].value);
                const precioUnitario = parseFloat(checkbox.closest('tr').querySelector('td:nth-child(3)').textContent);
                
                if (!isNaN(cantidad) && !isNaN(precioUnitario)) {
                    total += cantidad * precioUnitario;
                }
            }
        });

        totalElement.textContent = total.toFixed(2); // Actualiza el total
    }

    function filtrarProductos() {
    var tiendaSeleccionada = document.getElementById('propietario').value;
    var categoriaSeleccionada = document.getElementById('categoria').value;

    var productos = document.getElementsByClassName('producto-item');

    for (var i = 0; i < productos.length; i++) {
        var tiendaProducto = productos[i].getAttribute('data-tienda');
        var categoriaProducto = productos[i].getAttribute('data-categoria');

        // Verifica si el producto pertenece a la tienda y categoría seleccionadas
        var mostrar = true;
        
        if (tiendaSeleccionada && tiendaProducto !== tiendaSeleccionada) {
            mostrar = false;
        }

        if (categoriaSeleccionada && categoriaProducto !== categoriaSeleccionada) {
            mostrar = false;
        }

        // Mostrar u ocultar el producto según el filtro
        if (mostrar) {
            productos[i].style.display = "block";
        } else {
            productos[i].style.display = "none";
        }
    }
}
</script>
