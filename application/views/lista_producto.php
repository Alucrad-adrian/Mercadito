<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: rgb(149,210,211); min-height: 100vh;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Listar Productos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Mercadito Friki</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div id="confimacionInsert"></div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Custom CSS for table and background -->
                        <style>
                            .card {
                                background-color: #f8f9fa; /* Fondo del contenedor de la tabla */
                                border-radius: 10px; /* Bordes redondeados */
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra */
                                overflow-x: auto; /* Scroll horizontal para tablas grandes */
                            }

                            .card-body {
                                padding: 15px; /* Espacio alrededor de la tabla */
                            }

                            .table {
                                width: 100%; /* Asegura que la tabla ocupe todo el ancho del contenedor */
                                margin-bottom: 0; /* Alinea la tabla con el fondo del contenedor */
                            }

                            .table th,
                            .table td {
                                background-color: #ffffff; /* Fondo blanco para celdas */
                                border-color: #dee2e6; /* Color de borde de las celdas */
                                text-align: center; /* Centra el texto en las celdas */
                                vertical-align: middle; /* Alineación vertical */
                            }
                        </style>
                        <div class="card-body">
                            <!-- Filtros -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="filtroPropietario">Seleccionar Propietario:</label>
                                    <select id="filtroPropietario" class="form-control" onchange="filtrarProductos()">
                                        <option value="">Todos los Propietarios</option>
                                        <option value="pseudogente">Pseudogente</option>
                                        <option value="Z-store">Z-store</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="filtroCategoria">Seleccionar Categoría:</label>
                                    <select id="filtroCategoria" class="form-control" onchange="filtrarProductos()">
                                        <option value="">Todas las Categorías</option>
                                        <option value="libro">Libro</option>
                                        <option value="figura">Figura</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Tabla de productos -->
                            <table id="productosTabla" class="table table-bordered table-striped">
                                <thead>
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
                                </thead>
                                <tbody id="productos"> <!-- Corregido el ID -->
                                    <?php foreach ($productos->result() as $producto): ?>
                                    <tr>
                                        <td><?php echo $producto->idProducto; ?></td>
                                        <td><?php echo $producto->propietario; ?></td>
                                        <td><?php echo $producto->nombre_producto; ?></td>
                                        <td><?php echo $producto->descripcion; ?></td>
                                        <td><?php echo $producto->precio_unitario; ?></td>
                                        <td><?php echo $producto->categoria; ?></td>
                                        <td><?php echo $producto->habilitado ? 'Sí' : 'No'; ?></td>
                                        <td>
                                            <?php $imagen = $producto->imagen ?: 'interrogante.jpg'; ?>
                                            <img src="<?php echo base_url('uploads/productos/' . $imagen); ?>" alt="Imagen del producto" width="100">
                                        </td>
                                        <td><?php echo form_open_multipart("producto/modificar"); ?>
                                            <input type="hidden" name="idProducto" value="<?php echo $producto->idProducto; ?>">
                                            <button type="submit" class="btn btn-success">Modificar</button>
                                            <?php echo form_close(); ?>
                                        </td>
                                        <td><?php echo form_open_multipart("producto/eliminarbd"); ?>
                                            <input type="hidden" name="idProducto" value="<?php echo $producto->idProducto; ?>">
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                            <?php echo form_close(); ?>
                                        </td>
                                        <td><?php echo form_open_multipart("producto/" . ($producto->habilitado ? 'deshabilitarbd' : 'habilitarbd')); ?>
                                            <input type="hidden" name="idProducto" value="<?php echo $producto->idProducto; ?>">
                                            <button type="submit" class="btn btn-warning"><?php echo $producto->habilitado ? 'Deshabilitar' : 'Habilitar'; ?></button>
                                            <?php echo form_close(); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    function filtrarProductos() {
    var propietarioSeleccionado = document.getElementById('filtroPropietario').value.toLowerCase();
    var categoriaSeleccionada = document.getElementById('filtroCategoria').value.toLowerCase();
    var filas = document.getElementById('productos').getElementsByTagName('tr');
    
    for (var i = 0; i < filas.length; i++) {
        var columnaPropietario = filas[i].getElementsByTagName('td')[1].textContent.toLowerCase();
        var columnaCategoria = filas[i].getElementsByTagName('td')[5].textContent.toLowerCase();
        
        var mostrarFila = true;
        
        // Filtro por propietario
        if (propietarioSeleccionado && columnaPropietario !== propietarioSeleccionado) {
            mostrarFila = false;
        }
        
        // Filtro por categoría
        if (categoriaSeleccionada && columnaCategoria !== categoriaSeleccionada) {
            mostrarFila = false;
        }
        
        // Mostrar u ocultar la fila
        filas[i].style.display = mostrarFila ? '' : 'none';
    }
}


</script>