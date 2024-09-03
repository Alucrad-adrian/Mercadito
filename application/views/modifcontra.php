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
                        <li class="breadcrumb-item active">Mercadito friki</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h2>Modificar Contraseña</h2>
            <br>
            <div class="row"></div>

<?php
foreach($infousuario->result() as $row)
{
?>
<?php
echo form_open_multipart("estudiante/modificarPassword");
?>
<input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">

<div class="form-group">
    <label for="passwordActual">Contraseña Actual</label>
    <input type="password" class="form-control" name="passwordActual" placeholder="Escribe la contraseña actual" required>
</div>

<div class="form-group">
    <label for="nuevaPassword">Nueva Contraseña</label>
    <input type="password" class="form-control" name="nuevaPassword" placeholder="Escribe la nueva contraseña" minlength="6" required>
</div>

<div class="form-group">
    <label for="confirmarPassword">Confirmar Nueva Contraseña</label>
    <input type="password" class="form-control" name="confirmarPassword" placeholder="Confirma la nueva contraseña" minlength="6" required>
</div>

<button type="submit" class="btn btn-success">Modificar Contraseña</button>

<?php
echo form_close();
}
?>
 </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->