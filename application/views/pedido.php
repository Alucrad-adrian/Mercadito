<div>
<?php foreach($infousuario->result() as $row): ?>
<?php echo form_open_multipart('pedido/realizarPedido'); ?>
  
    <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">
    <input type="text" name="monto_total" placeholder="Monto Total">
    <input type="hidden" name="usuario_idusuario" value="<?php echo $row->idUsuario; ?>"> <!-- ID del usuario actual -->
    <!-- Otros campos del formulario -->
    <button type="submit">Realizar Pedido</button>

<?php echo form_close(); ?>
<?php endforeach; ?>
</div>
