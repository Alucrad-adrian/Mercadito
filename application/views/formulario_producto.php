<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: burlywood ;">
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
                        <li class="breadcrumb-item active">Agregar Producto</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h2>Agregar Producto</h2>
            <br>
            <div class="row">
                <div class="col-12">
                    <?php echo form_open_multipart("producto/agregarbd"); ?>
                    <div class="form-group">
                        <label for="propietario">Propietario</label>
                        <input type="text" class="form-control" name="propietario" placeholder="Escribe propietario" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre_producto">Nombre del Producto</label>
                        <input type="text" class="form-control" name="nombre_producto" placeholder="Escribe nombre del producto" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" name="descripcion" placeholder="Escribe descripción" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="precio_unitario">Precio Unitario</label>
                        <input type="number" class="form-control" name="precio_unitario" placeholder="Escribe precio unitario" required>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoría</label>
                        <input type="text" class="form-control" name="categoria" placeholder="Escribe categoría" required>
                    </div>
                    <div class="form-group">
                        <label for="habilitado">Habilitado</label>
                        <select class="form-control" name="habilitado" required>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen del Producto</label>
                        <input type="file" class="form-control" name="imagen" required>
                    </div>
                    <button type="submit" class="btn btn-success">Agregar producto</button>
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
