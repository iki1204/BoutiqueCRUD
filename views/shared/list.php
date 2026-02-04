<h1><?= htmlspecialchars($title) ?></h1>
<div class="actions" style="margin-bottom: 16px;">
    <a class="btn" href="<?= htmlspecialchars($baseRoute) ?>/crear">Crear</a>
</div>
<table>
    <thead>
        <tr>
            <?php foreach ($fields as $field) : ?>
                <th><?= htmlspecialchars($labels[$field] ?? $field) ?></th>
            <?php endforeach; ?>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item) : ?>
            <tr>
                <?php foreach ($fields as $field) : ?>
                    <td><?= htmlspecialchars((string) ($item[$field] ?? '')) ?></td>
                <?php endforeach; ?>
                <td>
                    <div class="actions">
                        <a class="btn secondary" href="<?= htmlspecialchars($baseRoute) ?>/editar/<?= (int) $item[$fields[0]] ?>">Editar</a>
                        <form class="inline" method="post" action="<?= htmlspecialchars($baseRoute) ?>/eliminar">
                            <input type="hidden" name="id" value="<?= (int) $item[$fields[0]] ?>">
                            <button class="btn danger" type="submit">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
