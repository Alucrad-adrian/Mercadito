<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: yellow;">
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
            <h2>Lista de deshabilitados</h2>
            <br>
            <a href="<?php echo base_url(); ?>index.php/usuarios/socios">
                <button type="button" class="btn btn-warning">VER HABILITADOS</button>
            </a>
            <br><br>
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Primer Apellido</th>
                                <th>Segundo Apellido</th>
                                <th>Rol</th>
                                <th>Correo</th>
                                <th>Carnet</th>
                                <th>Celular</th>
                                <th>Habilitar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 1;
                            foreach($usuarios->result() as $row)
                            {
                            ?>
                            <tr>
                                <td><?php echo $contador; ?></td>
                                <td>
                                    <?php 
                                    $foto = $row->foto;
                                    if($foto == "")
                                    {
                                        ?>
                                        <img src="<?php echo base_url(); ?>/uploads/perfil.jpg" width="100">
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo base_url(); ?>/uploads/<?php echo $foto; ?>" width="100">
                                        <?php
                                    }
                                    ?>
                                </td>   
                                <td><?php echo $row->nombre; ?></td>
                                <td><?php echo $row->apellido1; ?></td>
                                <td><?php echo $row->apellido2; ?></td>
                                <td><?php echo $row->rol; ?></td>
                                <td><?php echo $row->correo; ?></td>
                                <td><?php echo $row->carnet; ?></td>
                                <td><?php echo $row->celular; ?></td>
                                <td>
                                    <?php
                                    echo form_open_multipart("estudiante/habilitarbd");
                                    ?>
                                    <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">
                                    <button type="submit" class="btn btn-warning">Habilitar</button>
                                    <?php
                                    echo form_close();
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $contador++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
