<h1>Lista - de usuarios</h1>

<br>

<a href="<?php echo base_url(); ?>index.php/usuarios/logout">
<button type="button" class="btn btn-primary">Cerrar sesión</button>
</a>

<h2>Hola <?php echo $this->session->userdata('usuario'); ?></h2>
<h2>Hola <?php echo $this->session->userdata('rol'); ?></h2>
<h2>Hola <?php echo $this->session->userdata('idUsuario'); ?></h2>

<?php
echo date('Y/m/d H:i:s');
?>

<br>

<a href="<?php echo base_url(); ?>index.php/estudiante/deshabilitados">
<button type="button" class="btn btn-warning">VER DESHABILITADOS</button>
</a>

<br>

<a href="<?php echo base_url(); ?>index.php/estudiante/agregar">
<button type="button" class="btn btn-primary">Agregar usuario</button>
</a>

<table class="table">
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
                $foto = $row->foto;
                if ($foto == "") {
                    ?>
                    <img src="<?php echo base_url(); ?>/uploads/perfil.jpg" width="100">
                    <?php
                } else {
                    ?>
                    <img src="<?php echo base_url(); ?>/uploads/<?php echo $foto; ?>" width="100">
                    <?php
                }
                ?>
            </td>
            <td>
                <?php echo form_open_multipart("estudiante/subir"); ?>
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
</table>