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
            <h2>productos</h2>
            <br>
            <div class="row">
        <?php 
        $counter = 0;
        foreach ($productos as $producto): 
            // Determina la ruta de la imagen, si no hay imagen usa la por defecto
            $imagen_path = $producto->imagen ? base_url('uploads/productos/'.$producto->imagen) : base_url('uploads/productos/interrogante.jpg');
        ?>
            <div class="col-4">
                <div class="card shadow">
                    <h5 class="card-title" align="center"><?php echo $producto->nombre_producto; ?></h5>
                    <img " src="<?php echo $imagen_path; ?>" style="margin-left: 100px; height: 200px; width:150px;" alt="Imagen del producto">
                    <div class="card-body">
                        <p class="card-text"><?php echo $producto->descripcion; ?></p><br>
                        <p class="card-text"><?php echo $producto->precio_unitario; ?> .Bs</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-primary" onclick="abrirDetalles('<?php echo $producto->nombre_producto; ?>', '<?php echo $imagen_path; ?>', '<?php echo $producto->descripcion; ?>', '<?php echo $producto->precio_unitario; ?>')">Detalles</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php 
            $counter++;
            if ($counter % 3 == 0) {
                echo '</div><div class="row">';
            }
            ?>
        <?php endforeach; ?>
    </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
function abrirDetalles(nombre_producto, imagen, descripcion, precio) {
    document.getElementById('productoNombre').innerText = nombre;
    document.getElementById('productoImagen').src = imagen;
    document.getElementById('productoDescripcion').innerText = descripcion;
    document.getElementById('productoPrecio').innerText = precio;
    $('#detallesProducto').modal('show');
}
</script>
