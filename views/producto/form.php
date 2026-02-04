<h1><?= htmlspecialchars($title) ?></h1>
<form method="post" action="<?= htmlspecialchars($action) ?>">
    <div class="form-grid">
        <div>
            <label for="PRODUCTO_ID">ID</label>
            <input type="number" id="PRODUCTO_ID" name="PRODUCTO_ID" value="<?= htmlspecialchars((string) ($producto['PRODUCTO_ID'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="CATEGORIA_ID">Categoría</label>
            <select id="CATEGORIA_ID" name="CATEGORIA_ID" required>
                <option value="">Selecciona</option>
                <?php foreach ($categorias as $categoria) : ?>
                    <option value="<?= (int) $categoria['CATEGORIA_ID'] ?>" <?= isset($producto['CATEGORIA_ID']) && (int) $producto['CATEGORIA_ID'] === (int) $categoria['CATEGORIA_ID'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars((string) $categoria['DESCRIPCION']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="PROVEEDOR_ID">Proveedor</label>
            <select id="PROVEEDOR_ID" name="PROVEEDOR_ID" required>
                <option value="">Selecciona</option>
                <?php foreach ($proveedores as $proveedor) : ?>
                    <option value="<?= (int) $proveedor['PROVEEDOR_ID'] ?>" <?= isset($producto['PROVEEDOR_ID']) && (int) $producto['PROVEEDOR_ID'] === (int) $proveedor['PROVEEDOR_ID'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars((string) $proveedor['NOMBRE_EMPRESA']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="TALLA_ID">Talla</label>
            <select id="TALLA_ID" name="TALLA_ID" required>
                <option value="">Selecciona</option>
                <?php foreach ($tallas as $talla) : ?>
                    <option value="<?= (int) $talla['TALLA_ID'] ?>" <?= isset($producto['TALLA_ID']) && (int) $producto['TALLA_ID'] === (int) $talla['TALLA_ID'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars((string) $talla['DESCRIPCION']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="CODIGO">Código</label>
            <input type="text" id="CODIGO" name="CODIGO" value="<?= htmlspecialchars((string) ($producto['CODIGO'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="DESCRIPCION">Descripción</label>
            <input type="text" id="DESCRIPCION" name="DESCRIPCION" value="<?= htmlspecialchars((string) ($producto['DESCRIPCION'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="COLOR">Color</label>
            <input type="text" id="COLOR" name="COLOR" value="<?= htmlspecialchars((string) ($producto['COLOR'] ?? '')) ?>">
        </div>
        <div>
            <label for="MARCA">Marca</label>
            <input type="text" id="MARCA" name="MARCA" value="<?= htmlspecialchars((string) ($producto['MARCA'] ?? '')) ?>">
        </div>
        <div>
            <label for="STOCK">Stock</label>
            <input type="number" id="STOCK" name="STOCK" value="<?= htmlspecialchars((string) ($producto['STOCK'] ?? '')) ?>">
        </div>
        <div>
            <label for="PRECIO">Precio</label>
            <input type="number" step="0.01" id="PRECIO" name="PRECIO" value="<?= htmlspecialchars((string) ($producto['PRECIO'] ?? '')) ?>">
        </div>
    </div>
    <div class="actions" style="margin-top: 16px;">
        <button class="btn" type="submit">Guardar</button>
        <a class="btn secondary" href="/productos">Cancelar</a>
    </div>
</form>
