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
                        <a href="<?php echo base_url(); ?>index.php/pedido/pedido">
                        <button type="button" class="btn btn-primary">pedido</button>
                        </a>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
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
                                <tbody>
                                    <?php
                                    foreach ($productos->result() as $producto) {
                                    ?>
                                    <tr>
                                        <td><?php echo $producto->idProducto; ?></td>
                                        <td><?php echo $producto->propietario; ?></td>
                                        <td><?php echo $producto->nombre_producto; ?></td>
                                        <td><?php echo $producto->descripcion; ?></td>
                                        <td><?php echo $producto->precio_unitario; ?></td>
                                        <td><?php echo $producto->categoria; ?></td>
                                        <td><?php echo $producto->habilitado ? 'Sí' : 'No'; ?></td>
                                        <td>
                                            <?php 
                                            $imagen = $producto->imagen;
                                            if ($imagen == "") {
                                            ?>
                                                <img src="<?php echo base_url(); ?>/uploads/productos/interrogante.jpg" alt="Imagen por defecto" width="100">
                                            <?php
                                            } else {
                                            ?>
                                                <img src="<?php echo base_url(); ?>/uploads/productos/<?php echo $imagen; ?>" alt="Imagen del producto" width="100">
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo form_open_multipart("producto/modificar"); ?>
                                            <input type="hidden" name="idProducto" value="<?php echo $producto->idProducto; ?>">
                                            <button type="submit" class="btn btn-success">Modificar</button>
                                            <?php echo form_close(); ?>
                                        </td>
                                        <td>
                                            <?php echo form_open_multipart("producto/eliminarbd"); ?>
                                            <input type="hidden" name="idProducto" value="<?php echo $producto->idProducto; ?>">
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                            <?php echo form_close(); ?>
                                        </td>
                                        <td>
                                            <?php echo form_open_multipart("producto/" . ($producto->habilitado ? 'deshabilitarbd' : 'habilitarbd')); ?>
                                            <input type="hidden" name="idProducto" value="<?php echo $producto->idProducto; ?>">
                                            <button type="submit" class="btn btn-warning"><?php echo $producto->habilitado ? 'Deshabilitar' : 'Habilitar'; ?></button>
                                            <?php echo form_close(); ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
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
                                </tfoot>
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
