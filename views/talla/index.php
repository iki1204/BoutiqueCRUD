<h1>Tallas</h1>
<div class="actions" style="margin-bottom: 16px;">
    <a class="btn" href="/tallas/crear">Crear talla</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tallas as $talla) : ?>
            <tr>
                <td><?= (int) $talla['TALLA_ID'] ?></td>
                <td><?= htmlspecialchars((string) $talla['CODIGO']) ?></td>
                <td><?= htmlspecialchars((string) $talla['DESCRIPCION']) ?></td>
                <td>
                    <div class="actions">
                        <a class="btn secondary" href="/tallas/editar/<?= (int) $talla['TALLA_ID'] ?>">Editar</a>
                        <form class="inline" method="post" action="/tallas/eliminar">
                            <input type="hidden" name="id" value="<?= (int) $talla['TALLA_ID'] ?>">
                            <button class="btn danger" type="submit">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
