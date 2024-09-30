<h1>Lista de Ventas</h1>

<table>
    <tr>
        <th>ID Venta</th>
        <th>Cliente</th>
        <th>Monto Total</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($ventas as $venta): ?>
        <tr>
            <td><?= $venta->idventa ?></td>
            <td><?= $venta->cliente_id ?></td>
            <td><?= $venta->monto_total ?></td>
            <td><?= $venta->estado ?></td>
            <td><a href="<?= site_url('venta/detalle/'.$venta->idventa) ?>">Ver Detalles</a></td>
        </tr>
    <?php endforeach; ?>
</table>
