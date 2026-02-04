<h1>Categorías</h1>
<div class="actions" style="margin-bottom: 16px;">
    <a class="btn" href="/categorias/crear">Crear categoría</a>
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
        <?php foreach ($categorias as $categoria) : ?>
            <tr>
                <td><?= (int) $categoria['CATEGORIA_ID'] ?></td>
                <td><?= htmlspecialchars((string) $categoria['CODIGO']) ?></td>
                <td><?= htmlspecialchars((string) $categoria['DESCRIPCION']) ?></td>
                <td>
                    <div class="actions">
                        <a class="btn secondary" href="/categorias/editar/<?= (int) $categoria['CATEGORIA_ID'] ?>">Editar</a>
                        <form class="inline" method="post" action="/categorias/eliminar">
                            <input type="hidden" name="id" value="<?= (int) $categoria['CATEGORIA_ID'] ?>">
                            <button class="btn danger" type="submit">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
