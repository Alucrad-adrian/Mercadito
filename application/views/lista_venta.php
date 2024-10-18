<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: rgb(149,210,211); min-height: 100vh;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de ventas</h1>
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
                        <div class="card-body">
                            <!-- Filtros -->
                            <div class="row mb-3">
                                <!-- Aquí puedes agregar filtros si es necesario -->
                            </div>
                            <!-- Tabla de productos -->
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Propietario</th>
                                        <th>Nombre Producto</th>
                                        <th>Cantidad</th>
                                        <th>Monto Total</th>
                                
                                    </tr>
                                </thead>
                                <tbody id="pedidos"> 
                                    <?php if (!empty($pedidos)): ?>
                                        <?php foreach ($pedidos as $pedido): ?>
                                        <tr>
                                            <td><?php echo $pedido->propietario; ?></td> <!-- Columna de propietario -->
                                            <td><?php echo $pedido->nombre_producto; ?></td>
                                            <td><?php echo $pedido->cantidad; ?></td>
                                            <td><?php echo $pedido->monto_total; ?> Bs.</td>
                                           
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6">No hay ventas.</td>
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
