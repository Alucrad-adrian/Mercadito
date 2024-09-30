<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: lightskyblue;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Crear Puesto para el Usuario</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Crear Puesto</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <h2>Formulario para Crear Puesto</h2>
            <br>

            <div class="row">
                <div class="col-12">
                    <?php echo form_open_multipart('puesto/crear_puesto'); ?>
                    
                    <!-- ID del usuario oculto -->
                    <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
                    
                    <div class="form-group">
                        <label for="nombre_puesto">Nombre del Puesto</label>
                        <input type="text" class="form-control" name="nombre_puesto" placeholder="Escribe el nombre del puesto" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción del Puesto</label>
                        <textarea class="form-control" name="descripcion" placeholder="Escribe la descripción del puesto" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Crear Puesto</button>
                    
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
<!-- /.content-wrapper -->
