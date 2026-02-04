<h1>Ventas</h1>
<div class="actions" style="margin-bottom: 16px;">
    <a class="btn" href="/ventas/crear">Crear venta</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Empleado</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Método de pago</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ventas as $venta) : ?>
            <tr>
                <td><?= (int) $venta['VENTA_ID'] ?></td>
                <td><?= htmlspecialchars((string) $venta['FECHA']) ?></td>
                <td><?= htmlspecialchars((string) $venta['CLIENTE']) ?></td>
                <td><?= htmlspecialchars((string) $venta['EMPLEADO']) ?></td>
                <td><?= htmlspecialchars((string) $venta['TOTAL']) ?></td>
                <td><?= htmlspecialchars((string) $venta['ESTADO']) ?></td>
                <td><?= htmlspecialchars((string) $venta['METODO_PAGO']) ?></td>
                <td>
                    <div class="actions">
                        <a class="btn secondary" href="/ventas/editar/<?= (int) $venta['VENTA_ID'] ?>">Editar</a>
                        <form class="inline" method="post" action="/ventas/eliminar">
                            <input type="hidden" name="id" value="<?= (int) $venta['VENTA_ID'] ?>">
                            <button class="btn danger" type="submit">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
