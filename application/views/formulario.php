<br><br>
<h1>Agregar usuario</h1>
<br>

<?php
echo form_open_multipart("estudiante/agregarbd");
?>

<input type="text" class="form-control" name="nombre" placeholder="Escribe nombre" required>
<input type="text" class="form-control" name="apellido1" placeholder="Escribe apellido paterno" minlength="3" maxlength="20" required>
<input type="text" class="form-control" name="apellido2" placeholder="Escribe apellido materno" required>
<input type="text" class="form-control" name="rol" placeholder="Escribe rol" required>
<input type="email" class="form-control" name="correo" placeholder="Escribe correo" required>
<input type="text" class="form-control" name="carnet" placeholder="Escribe carnet" required>
<input type="text" class="form-control" name="celular" placeholder="Escribe celular" required>
<input type="text" class="form-control" name="usuario" placeholder="Escribe usuario" required>
<input type="password" class="form-control" name="password" placeholder="Escribe password" required>
<button type="submit" class="btn btn-success">Agregar usuario</button>
    
<?php
echo form_close();
?>
