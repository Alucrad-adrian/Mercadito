
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
            
            <h2>Productos</h2>
            <div class="row">
            <div class="col-sm-6">
                <!-- Select para seleccionar tienda (propietario) -->
            <div class="form-group">
                <label for="propietario">Tienda</label>
                <select id="propietario" class="form-control" onchange="filtrarProductos()">
                    <option value="">Todas las tiendas</option>
                    <option value="pseudogente">pseudogente</option>
                    <option value="Z-store">Z-store</option>
                    <?php foreach ($propietarios as $propietario): ?>
                        <option value="<?php echo $propietario->propietario; ?>"><?php echo $propietario->propietario; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            </div>
            <div class="col-sm-6">
                <!-- Select para seleccionar categoría -->
            <div class="form-group">
                <label for="categoria">Categoría</label>
                <select id="categoria" class="form-control" onchange="filtrarProductos()">
                    <option value="">Todas las categorías</option>
                    <option value="libro">libro</option>
                    <option value="figura">figura</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria->categoria; ?>"><?php echo $categoria->categoria; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            </div>
            </div>
            
            <br>
            <div class="row" id="productos-container">
            <?php 
            $counter = 0;
            foreach ($productos as $producto): 
                // Determina la ruta de la imagen, si no hay imagen usa la por defecto
                $imagen_path = $producto->imagen ? base_url('uploads/productos/'.$producto->imagen) : base_url('uploads/productos/interrogante.jpg');
            ?>
                <div class="col-4 producto-item" data-tienda="<?php echo $producto->propietario; ?>" data-categoria="<?php echo $producto->categoria; ?>">
                    <div class="card shadow">
                        <h5 class="card-title" align="center"><?php echo $producto->nombre_producto; ?></h5>
                        <img src="<?php echo $imagen_path; ?>" style="margin-left: 100px; height: 200px; width:150px;" alt="Imagen del producto">
                        <div class="card-body">
                            <p class="card-text"><?php echo $producto->descripcion; ?></p><br>
                            <p class="card-text"><?php echo $producto->precio_unitario; ?> .Bs</p>
                            <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-primary" onclick="abrirDetalles('<?php echo $producto->nombre_producto; ?>', '<?php echo $imagen_path; ?>', '<?php echo $producto->descripcion; ?>', '<?php echo $producto->precio_unitario; ?>', '<?php echo $producto->idProducto; ?>')">Detalles</button>
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
<!-- Incluye los archivos de jQuery y Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<!-- Modal para Detalles de Producto -->
<div class="modal fade" id="detallesProducto" tabindex="-1" role="dialog" aria-labelledby="detallesProductoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productoNombre"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="productoImagen" src="" alt="Imagen del producto" class="img-fluid mb-3" style="display: block; margin: 0 auto; height: 300px;">
                <p><strong>Descripción:</strong></p>
                <p id="productoDescripcion"></p>
                <p><strong>Precio:</strong> <span id="productoPrecio"></span> Bs</p>
                <!-- Input oculto para almacenar el ID del producto -->
                <input type="hidden" id="productoId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" onclick="reservarProducto()">Reservar</button>
                <button type="button" class="btn btn-success" onclick="comprarProducto()">Comprar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Content Wrapper -->


<!-- /.content-wrapper -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>


<script>
function filtrarProductos() {
    var tiendaSeleccionada = document.getElementById('propietario').value;
    var categoriaSeleccionada = document.getElementById('categoria').value;

    var productos = document.getElementsByClassName('producto-item');

    for (var i = 0; i < productos.length; i++) {
        var tiendaProducto = productos[i].getAttribute('data-tienda');
        var categoriaProducto = productos[i].getAttribute('data-categoria');

        // Verifica si el producto pertenece a la tienda y categoría seleccionadas
        var mostrar = true;
        
        if (tiendaSeleccionada && tiendaProducto !== tiendaSeleccionada) {
            mostrar = false;
        }

        if (categoriaSeleccionada && categoriaProducto !== categoriaSeleccionada) {
            mostrar = false;
        }

        // Mostrar u ocultar el producto según el filtro
        if (mostrar) {
            productos[i].style.display = "block";
        } else {
            productos[i].style.display = "none";
        }
    }
}






</script>
