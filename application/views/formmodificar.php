<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: cornflowerblue;">
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
                        <li class="breadcrumb-item active">Mercadito friki</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h2>Modificar usuario</h2>
            <br>
            <div class="row">
                <div class="col-12">
                    <?php foreach($infousuario->result() as $row): ?>
                    <?php echo form_open_multipart("estudiante/modificarbd"); ?>
                    <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Escribe nombre" value="<?php echo $row->nombre; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="apellido1">Apellido Paterno</label>
                        <input type="text" class="form-control" name="apellido1" placeholder="Escribe apellido paterno" minlength="3" maxlength="20" value="<?php echo $row->apellido1; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="apellido2">Apellido Materno</label>
                        <input type="text" class="form-control" name="apellido2" placeholder="Escribe apellido materno" value="<?php echo $row->apellido2; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <input type="text" class="form-control" name="rol" placeholder="Escribe rol" value="<?php echo $row->rol; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" name="correo" placeholder="Escribe correo" value="<?php echo $row->correo; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="carnet">Carnet</label>
                        <input type="text" class="form-control" name="carnet" placeholder="Escribe carnet" value="<?php echo $row->carnet; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="text" class="form-control" name="celular" placeholder="Escribe celular" value="<?php echo $row->celular; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-success">Modificar usuario</button>

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
