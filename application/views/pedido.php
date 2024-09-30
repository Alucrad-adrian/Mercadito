

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: lightskyblue ;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Mercadito friki</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reserva</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h2>Reserva</h2>
            <br>
            <div class="row">
                <div class="col-12">
    <?php foreach ($infousuario->result() as $row): ?>
        <?php echo form_open_multipart('pedido/realizarPedido'); ?>
        
        <!-- ID del usuario actual (oculto) -->
        <input type="hidden" name="usuario_idusuario" value="<?php echo $row->idUsuario; ?>">
        <div class="form-group">
            <label for="monto_total">Monto</label>
            <input type="number" class="form-control" name="monto_total" placeholder="monto_total" required>
        </div>
        <div class="form-group">
            <label for="producto_id">nombre del producto</label>
            <input type="number" class="form-control" name="producto_id" placeholder="noombre del producto" required>
        </div>
        <div class="form-group">
            <label for="Cantidad">Cantidad</label>
            <input type="number" class="form-control" name="Cantidad" placeholder="Cantidad" required>
        </div>
        <!-- Monto total del pedido -->
        
        
        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn btn-success">Realizar reserva</button>

        <?php echo form_close(); ?>
    <?php endforeach; ?>
</div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
