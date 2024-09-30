<script>
    // Filtra los puestos en función del propietario seleccionado
    document.getElementById('propietario').addEventListener('change', function() {
        var propietarioId = this.value;
        var puestoSelect = document.getElementById('puesto');
        
        // Muestra solo los puestos relacionados con el propietario seleccionado
        for (var i = 0; i < puestoSelect.options.length; i++) {
            var option = puestoSelect.options[i];
            option.style.display = option.getAttribute('data-propietario') === propietarioId ? 'block' : 'none';
        }
    });
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: burlywood;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Mercadito Friki</h1>
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
                    <?php echo form_open_multipart("producto/agregarbdVendedor"); ?>

                    <!-- Select para Propietario -->
                    <div class="form-group">
                    <label for="propietario">Nombre del Propietario</label>
                    <select class="form-control" name="propietario" id="propietario" required>
                    <option value="">Selecciona un vendedor</option>
                    <?php foreach ($vendedores as $vendedor): ?>
                        <option value="<?php echo $vendedor->nombre; ?>"><?php echo $vendedor->nombre; ?></option>
                    <?php endforeach; ?>
                </select>
                    </div>

                    <!-- Nombre del Producto -->
                    <div class="form-group">
                        <label for="nombre_producto">Nombre del Producto</label>
                        <input type="text" class="form-control" name="nombre_producto" placeholder="Escribe nombre del producto" required>
                    </div>

                    <!-- Descripción -->
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" name="descripcion" placeholder="Escribe descripción" required></textarea>
                    </div>

                    <!-- Precio Unitario -->
                    <div class="form-group">
                        <label for="precio_unitario">Precio Unitario</label>
                        <input type="number" class="form-control" name="precio_unitario" placeholder="Escribe precio unitario" required>
                    </div>

                    <!-- Select para Categoría -->
                    <div class="form-group">
                        <label for="categoria">Categoría</label>
                        <select class="form-control" name="categoria" required>
                            <option value="">Selecciona la categoría</option>
                            <option value="libro">Libro</option>
                            <option value="figura">Figura</option>
                        </select>
                    </div>

                    <!-- Habilitado -->
                    <div class="form-group">
                        <label for="habilitado">Habilitado</label>
                        <select class="form-control" name="habilitado" required>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <!-- Imagen del Producto -->
                    <div class="form-group">
                        <label for="imagen">Imagen del Producto</label>
                        <input type="file" class="form-control" name="imagen" required>
                    </div>

                    <!-- Si el usuario es vendedor, permitir seleccionar un puesto -->
                    <div class="form-group">
                    <label for="puesto">Puesto</label>
                        <select class="form-control" id="puesto" name="puesto" required>
                        <option value="">Selecciona un puesto</option>
                        <?php foreach ($puestos as $puesto): ?>
                            <option value="<?php echo $puesto->nombre_puesto; ?>" data-propietario="<?php echo $puesto->propietario; ?>">
                                <?php echo $puesto->nombre_puesto; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
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
