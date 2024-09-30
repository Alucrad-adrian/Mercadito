<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: rgb(149,210,211); min-height: 100vh;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nuevos Productos</h1>
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
                            <?php if (!empty($notificaciones)): ?>
                                <div class="row">
                                <?php foreach ($notificaciones as $notificacion): ?>
                                    <div class="col-md-4">
                                        <div class="card shadow mb-4">
                                            <img src="<?php echo base_url('uploads/productos/' . $notificacion->imagen_producto); ?>" class="card-img-top" alt="Imagen del Producto" width="40" height="300">
                                            <div class="card-body">
                                                <p class="card-text">descripcion: <br><?php echo $notificacion->descripcion_producto; ?></p>
                                                <p class="card-text">tienda: <br><?php echo $notificacion->propietario; ?></p>
                                                <p class="card-text">precio: <br><?php echo $notificacion->precio; ?> 'Bs'</p>
                                                <p class="card-text"><small class="text-muted">Fecha: <?php echo $notificacion->fecha_creacion; ?></small></p>
                                                <a href="#" class="btn btn-primary">Ver Detalles</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p>No tienes notificaciones.</p>
                            <?php endif; ?>
                        </div>

                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
    

</body>
</html>
