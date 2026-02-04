<h1>Empleados</h1>
<div class="actions" style="margin-bottom: 16px;">
    <a class="btn" href="/?controller=empleado&action=create">Crear empleado</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Apellido</th>
            <th>Cargo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Fecha ingreso</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($empleados as $empleado) : ?>
            <tr>
                <td><?= (int) $empleado['EMPLEADO_ID'] ?></td>
                <td><?= htmlspecialchars((string) $empleado['CODIGO']) ?></td>
                <td><?= htmlspecialchars((string) $empleado['APELLIDO']) ?></td>
                <td><?= htmlspecialchars((string) $empleado['CARGO']) ?></td>
                <td><?= htmlspecialchars((string) $empleado['TELEFONO']) ?></td>
                <td><?= htmlspecialchars((string) $empleado['DIRECCION']) ?></td>
                <td><?= htmlspecialchars((string) $empleado['FECHA_INGRESO']) ?></td>
                <td>
                    <div class="actions">
                        <a class="btn secondary" href="/?controller=empleado&action=edit&id=<?= (int) $empleado['EMPLEADO_ID'] ?>">Editar</a>
                        <form class="inline" method="post" action="/?controller=empleado&action=delete">
                            <input type="hidden" name="id" value="<?= (int) $empleado['EMPLEADO_ID'] ?>">
                            <button class="btn danger" type="submit">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
