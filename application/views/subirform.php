<h1>subir fotografia de  estudiante</h1>
<br>
<?php
foreach($infousuario->result() as $row)
{
?>

<?php
echo form_open_multipart("estudiante/subir");
?>
<input type="hidden" class="form-control" name="idUsuario" value="<?php echo $row->idUsuario; ?>">
<br>
'<input type="file" name="userfile" />';
<br>
<button type="submit" class="btn btn-success">subir</button>
	
<?php
echo form_close();
}
?>
