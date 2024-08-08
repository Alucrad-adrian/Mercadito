<h1>Lista de usuarios</h1>

<br>

<a href="<?php echo base_url(); ?>index.php/estudiante/curso">
<button type="button" class="btn btn-warning">VER HABILITADOS</button>
</a>

<table class="table">
    <thead>
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
