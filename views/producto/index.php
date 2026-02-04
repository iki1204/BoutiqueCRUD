<h1>Productos</h1>
<div class="actions" style="margin-bottom: 16px;">
    <a class="btn" href="/productos/crear">Crear producto</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Descripción</th>
            <th>Categoría</th>
            <th>Proveedor</th>
            <th>Talla</th>
            <th>Color</th>
            <th>Marca</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto) : ?>
            <tr>
                <td><?= (int) $producto['PRODUCTO_ID'] ?></td>
                <td><?= htmlspecialchars((string) $producto['CODIGO']) ?></td>
                <td><?= htmlspecialchars((string) $producto['DESCRIPCION']) ?></td>
                <td><?= htmlspecialchars((string) $producto['CATEGORIA']) ?></td>
                <td><?= htmlspecialchars((string) $producto['PROVEEDOR']) ?></td>
                <td><?= htmlspecialchars((string) $producto['TALLA']) ?></td>
                <td><?= htmlspecialchars((string) $producto['COLOR']) ?></td>
                <td><?= htmlspecialchars((string) $producto['MARCA']) ?></td>
                <td><?= htmlspecialchars((string) $producto['STOCK']) ?></td>
                <td><?= htmlspecialchars((string) $producto['PRECIO']) ?></td>
                <td>
                    <div class="actions">
                        <a class="btn secondary" href="/productos/editar/<?= (int) $producto['PRODUCTO_ID'] ?>">Editar</a>
                        <form class="inline" method="post" action="/productos/eliminar">
                            <input type="hidden" name="id" value="<?= (int) $producto['PRODUCTO_ID'] ?>">
                            <button class="btn danger" type="submit">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
