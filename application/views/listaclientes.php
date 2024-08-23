  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: rgb(149,210,211); min-height: 100vh;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Listar Clientes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mercadito Friki</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div id="confimacionInsert"></div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- Custom CSS for table and background -->
              <style>
                .card {
                  background-color: #f8f9fa; /* Fondo del contenedor de la tabla */
                  border-radius: 10px; /* Bordes redondeados */
                  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra */
                  overflow-x: auto; /* Scroll horizontal para tablas grandes */
                }

                .card-body {
                  padding: 15px; /* Espacio alrededor de la tabla */
                }

                .table {
                  width: 100%; /* Asegura que la tabla ocupe todo el ancho del contenedor */
                  margin-bottom: 0; /* Alinea la tabla con el fondo del contenedor */
                }

                .table th,
                .table td {
                  background-color: #ffffff; /* Fondo blanco para celdas */
                  border-color: #dee2e6; /* Color de borde de las celdas */
                  text-align: center; /* Centra el texto en las celdas */
                  vertical-align: middle; /* Alineación vertical */
                }
              </style>

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>NRO</th>
                      <th>Imagen</th>
                      <th>Subir</th>
                      <th>Nombre</th>
                      <th>Apellido1</th>
                      <th>Apellido2</th>
                      <th>Rol</th>
                      <th>Correo</th>
                      <th>Carnet</th>
                      <th>Celular</th>
                      <th>Modificar</th>
                      <th>Eliminar</th>
                      <th>Deshabilitar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $contador = 1;
                    foreach ($usuarios->result() as $row) {
                    ?>
                    <tr>
                      <td><?php echo $contador; ?></td>
                      <td>
                        <?php
                        $foto=$row->foto;
                        if($foto=="")
                        {
                            ?>
                            <img src="<?php echo base_url(); ?>/uploads/perfil.jpg" width="50px">
                            <?php
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo base_url(); ?>/uploads/<?php echo $foto; ?>" width="50px">
                            <?php
                        }

                        ?>
                    </td>
                      <td>
                        <?php echo form_open_multipart("estudiante/subirfoto"); ?>
                        <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">
                        <button type="submit" class="btn btn-success">Subir</button>
                        <?php echo form_close(); ?>
                      </td>
                      <td><?php echo $row->nombre; ?></td>
                      <td><?php echo $row->apellido1; ?></td>
                      <td><?php echo $row->apellido2; ?></td>
                      <td><?php echo $row->rol; ?></td>
                      <td><?php echo $row->correo; ?></td>
                      <td><?php echo $row->carnet; ?></td>
                      <td><?php echo $row->celular; ?></td>
                      <td>
                        <?php echo form_open_multipart("estudiante/modificar"); ?>
                        <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">
                        <button type="submit" class="btn btn-success">Modificar</button>
                        <?php echo form_close(); ?>
                      </td>
                      <td>
                        <?php echo form_open_multipart("estudiante/eliminarbd"); ?>
                        <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <?php echo form_close(); ?>
                      </td>
                      <td>
                        <?php echo form_open_multipart("estudiante/deshabilitarbd"); ?>
                        <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">
                        <button type="submit" class="btn btn-warning">Deshabilitar</button>
                        <?php echo form_close(); ?>
                      </td>
                    </tr>
                    <?php
                    $contador++;
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>NRO</th>
                      <th>Imagen</th>
                      <th>Subir</th>
                      <th>Nombre</th>
                      <th>Apellido1</th>
                      <th>Apellido2</th>
                      <th>Rol</th>
                      <th>Correo</th>
                      <th>Carnet</th>
                      <th>Celular</th>
                      <th>Modificar</th>
                      <th>Eliminar</th>
                      <th>Deshabilitar</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

