<div class="card">
    <div class="card-body">
        <h3>Pedidos Reservados</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre Producto</th>
                    <th>Cantidad</th>
                    <th>Monto Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                <tr>
                    <td><?php echo $pedido->nombre_producto; ?></td>
                    <td><?php echo $pedido->cantidad; ?></td>
                    <td><?php echo $pedido->monto_total; ?> Bs.</td>
                    <td>
                        <!-- Botón para confirmar la venta -->
                        <?php echo form_open('transaccion/confirmar_venta'); ?>
                            <input type="hidden" name="idTransaccion" value="<?php echo $pedido->idTransaccion; ?>">
                            <button type="submit" class="btn btn-success">Venta Realizada</button>
                        <?php echo form_close(); ?>

                        <!-- Botón para cancelar la transacción -->
                        <?php echo form_open('transaccion/cancelar_venta'); ?>
                            <input type="hidden" name="idTransaccion" value="<?php echo $pedido->idTransaccion; ?>">
                            <button type="submit" class="btn btn-danger">Cancelar</button>
                        <?php echo form_close(); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
