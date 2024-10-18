<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: rgb(149,210,211); min-height: 100vh;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de Pedidos</h1>
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
                                
                            
                            <!-- Tabla de productos -->
                            <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre Producto</th>
                    <th>Cantidad</th>
                    <th>Monto Total</th>
                    <th>confirmar venta</th>
                    <th>cancelar pedido</th>
                </tr>
            </thead>
            <tbody id="pedidos"> 
    <?php if (!empty($pedidos)): ?>
        <?php foreach ($pedidos as $pedido): ?>
        <tr>
            <td><?php echo $pedido->nombre_producto; ?></td>
            <td><?php echo $pedido->cantidad; ?></td>
            <td><?php echo $pedido->monto_total; ?> Bs.</td>
            <td>
                <?php echo form_open('pedido/venta_realizada'); ?>
                <input type="hidden" name="idTransaccion" value="<?php echo $pedido->idTransaccion; ?>">
                <button type="submit" class="btn btn-success">Venta Realizada</button>
                <?php echo form_close(); ?>
            </td>
            <td>
                <?php echo form_open('pedido/cancelar'); ?>
                <input type="hidden" name="idTransaccion" value="<?php echo $pedido->idTransaccion; ?>">
                <button type="submit" class="btn btn-danger">Cancelar</button>
                <?php echo form_close(); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No hay pedidos reservados.</td>
        </tr>
    <?php endif; ?>
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
