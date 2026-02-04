<h1>Clientes</h1>
<div class="actions" style="margin-bottom: 16px;">
    <a class="btn" href="/clientes/crear">Crear cliente</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $cliente) : ?>
            <tr>
                <td><?= (int) $cliente['CLIENTE_ID'] ?></td>
                <td><?= htmlspecialchars((string) $cliente['CODIGO']) ?></td>
                <td><?= htmlspecialchars((string) $cliente['APELLIDO']) ?></td>
                <td><?= htmlspecialchars((string) $cliente['TELEFONO']) ?></td>
                <td><?= htmlspecialchars((string) $cliente['EMAIL']) ?></td>
                <td><?= htmlspecialchars((string) $cliente['DIRECCION']) ?></td>
                <td>
                    <div class="actions">
                        <a class="btn secondary" href="/clientes/editar/<?= (int) $cliente['CLIENTE_ID'] ?>">Editar</a>
                        <form class="inline" method="post" action="/clientes/eliminar">
                            <input type="hidden" name="id" value="<?= (int) $cliente['CLIENTE_ID'] ?>">
                            <button class="btn danger" type="submit">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
