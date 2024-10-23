
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
            
            <h2>Productos</h2><br>
            <p>Nota: si quiere reservar solo una cosa por cantidad en esta pagina si quiere reservar varios productos hagalo aqui</p>
            <a href="<?php echo base_url(); ?>index.php/usuarios/ventanareservas">
            <button type="button" class="btn btn-success">reserva productos</button>
            </a>
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
                <p class="card-text"><?php echo $producto->propietario; ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Formulario para reservar el producto -->
                    <?php echo form_open('pedido/vistapedido', ['method' => 'post']); ?>
                        <input type="hidden" name="productoId" value="<?php echo $producto->idProducto; ?>">
                        <input type="hidden" name="nombreProducto" value="<?php echo $producto->nombre_producto; ?>">
                        <input type="hidden" name="propietarioProducto" value="<?php echo $producto->propietario; ?>">
                        <input type="hidden" name="precioProducto" value="<?php echo $producto->precio_unitario; ?>">
                        <input type="hidden" name="puestoProducto" value="<?php echo $producto->idPuesto; ?>">
                        <button type="submit" class="btn btn-primary">Reservar</button>
                    <?php echo form_close(); ?>
                            
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
