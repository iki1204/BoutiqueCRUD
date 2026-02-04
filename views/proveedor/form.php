<h1><?= htmlspecialchars($title) ?></h1>
<form method="post" action="<?= htmlspecialchars($action) ?>">
    <div class="form-grid">
        <div>
            <label for="PROVEEDOR_ID">ID</label>
            <input type="number" id="PROVEEDOR_ID" name="PROVEEDOR_ID" value="<?= htmlspecialchars((string) ($proveedor['PROVEEDOR_ID'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="NOMBRE_EMPRESA">Empresa</label>
            <input type="text" id="NOMBRE_EMPRESA" name="NOMBRE_EMPRESA" value="<?= htmlspecialchars((string) ($proveedor['NOMBRE_EMPRESA'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="TELEFONO">Teléfono</label>
            <input type="text" id="TELEFONO" name="TELEFONO" value="<?= htmlspecialchars((string) ($proveedor['TELEFONO'] ?? '')) ?>">
        </div>
        <div>
            <label for="EMAIL">Email</label>
            <input type="email" id="EMAIL" name="EMAIL" value="<?= htmlspecialchars((string) ($proveedor['EMAIL'] ?? '')) ?>">
        </div>
        <div>
            <label for="DIRECCION">Dirección</label>
            <input type="text" id="DIRECCION" name="DIRECCION" value="<?= htmlspecialchars((string) ($proveedor['DIRECCION'] ?? '')) ?>">
        </div>
        <div>
            <label for="CIUDAD">Ciudad</label>
            <input type="text" id="CIUDAD" name="CIUDAD" value="<?= htmlspecialchars((string) ($proveedor['CIUDAD'] ?? '')) ?>">
        </div>
    </div>
    <div class="actions" style="margin-top: 16px;">
        <button class="btn" type="submit">Guardar</button>
        <a class="btn secondary" href="/proveedores">Cancelar</a>
    </div>
</form>
