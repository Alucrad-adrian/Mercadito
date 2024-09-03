<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: orange;">
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
                        <li class="breadcrumb-item active">Subir Fotografía de Usuario</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h2>Subir Fotografía de Usuario</h2>
            <br>
            <div class="row">
                <div class="col-12">
                    <?php foreach($infousuario->result() as $row): ?>
                        <?php echo form_open_multipart("estudiante/subir"); ?>
                            <input type="hidden" class="form-control" name="idUsuario" value="<?php echo $row->idUsuario; ?>">
                            <div class="form-group">
                                <label for="userfile">Selecciona la fotografía:</label>
                                <input type="file" name="imagen" class="form-control-file">
                                <input type="hidden" name="imagen_actual" value="<?php echo $row->foto; ?>">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success">Subir</button>
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
