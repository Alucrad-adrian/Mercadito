<br><br>
<h1>subir fotografia de  estudiante</h1>
<br>

<?php
echo form_open_multipart("estudiante/subir");
?>

<input type="hidden" class="form-control" name="idUsuario" value="<?php echo $idUsuario; ?>">
<input type="file" name="userfile">
<button type="submit" class="btn btn-success">subir</button>
	
<?php
echo form_close();
?>