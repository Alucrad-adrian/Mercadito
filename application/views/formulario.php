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
                        <li class="breadcrumb-item active">Agregar Usuario</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h2>Agregar Usuario</h2>
            <br>
            <div class="row">
                <div class="col-12">
                    <?php echo form_open_multipart("estudiante/agregarbd"); ?>
                    
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Escribe nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="apellido1">Apellido Paterno</label>
                        <input type="text" class="form-control" name="apellido1" placeholder="Escribe apellido paterno" minlength="3" maxlength="20" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="apellido2">Apellido Materno</label>
                        <input type="text" class="form-control" name="apellido2" placeholder="Escribe apellido materno" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <input type="text" class="form-control" name="rol" placeholder="Escribe rol" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" name="correo" placeholder="Escribe correo" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="carnet">Carnet</label>
                        <input type="text" class="form-control" name="carnet" placeholder="Escribe carnet" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="text" class="form-control" name="celular" placeholder="Escribe celular" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" name="usuario" placeholder="Escribe usuario" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" placeholder="Escribe password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-success">Agregar usuario</button>
                    
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
