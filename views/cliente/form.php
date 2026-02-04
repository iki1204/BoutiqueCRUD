<h1><?= htmlspecialchars($title) ?></h1>
<form method="post" action="<?= htmlspecialchars($action) ?>">
    <div class="form-grid">
        <div>
            <label for="CLIENTE_ID">ID</label>
            <input type="number" id="CLIENTE_ID" name="CLIENTE_ID" value="<?= htmlspecialchars((string) ($cliente['CLIENTE_ID'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="CODIGO">Código</label>
            <input type="text" id="CODIGO" name="CODIGO" value="<?= htmlspecialchars((string) ($cliente['CODIGO'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="APELLIDO">Apellido</label>
            <input type="text" id="APELLIDO" name="APELLIDO" value="<?= htmlspecialchars((string) ($cliente['APELLIDO'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="TELEFONO">Teléfono</label>
            <input type="text" id="TELEFONO" name="TELEFONO" value="<?= htmlspecialchars((string) ($cliente['TELEFONO'] ?? '')) ?>">
        </div>
        <div>
            <label for="EMAIL">Email</label>
            <input type="email" id="EMAIL" name="EMAIL" value="<?= htmlspecialchars((string) ($cliente['EMAIL'] ?? '')) ?>">
        </div>
        <div>
            <label for="DIRECCION">Dirección</label>
            <input type="text" id="DIRECCION" name="DIRECCION" value="<?= htmlspecialchars((string) ($cliente['DIRECCION'] ?? '')) ?>">
        </div>
    </div>
    <div class="actions" style="margin-top: 16px;">
        <button class="btn" type="submit">Guardar</button>
        <a class="btn secondary" href="/?controller=cliente">Cancelar</a>
    </div>
</form>
