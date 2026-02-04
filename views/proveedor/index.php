<h1>Proveedores</h1>
<div class="actions" style="margin-bottom: 16px;">
    <a class="btn" href="/?controller=proveedor&action=create">Crear proveedor</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Empresa</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Ciudad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($proveedores as $proveedor) : ?>
            <tr>
                <td><?= (int) $proveedor['PROVEEDOR_ID'] ?></td>
                <td><?= htmlspecialchars((string) $proveedor['NOMBRE_EMPRESA']) ?></td>
                <td><?= htmlspecialchars((string) $proveedor['TELEFONO']) ?></td>
                <td><?= htmlspecialchars((string) $proveedor['EMAIL']) ?></td>
                <td><?= htmlspecialchars((string) $proveedor['DIRECCION']) ?></td>
                <td><?= htmlspecialchars((string) $proveedor['CIUDAD']) ?></td>
                <td>
                    <div class="actions">
                        <a class="btn secondary" href="/?controller=proveedor&action=edit&id=<?= (int) $proveedor['PROVEEDOR_ID'] ?>">Editar</a>
                        <form class="inline" method="post" action="/?controller=proveedor&action=delete">
                            <input type="hidden" name="id" value="<?= (int) $proveedor['PROVEEDOR_ID'] ?>">
                            <button class="btn danger" type="submit">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
