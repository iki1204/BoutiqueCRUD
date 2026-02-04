<h1><?= htmlspecialchars($title) ?></h1>
<form method="post" action="<?= htmlspecialchars($action) ?>">
    <div class="form-grid">
        <div>
            <label for="TALLA_ID">ID</label>
            <input type="number" id="TALLA_ID" name="TALLA_ID" value="<?= htmlspecialchars((string) ($talla['TALLA_ID'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="CODIGO">Código</label>
            <input type="text" id="CODIGO" name="CODIGO" value="<?= htmlspecialchars((string) ($talla['CODIGO'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="DESCRIPCION">Descripción</label>
            <input type="text" id="DESCRIPCION" name="DESCRIPCION" value="<?= htmlspecialchars((string) ($talla['DESCRIPCION'] ?? '')) ?>" required>
        </div>
    </div>
    <div class="actions" style="margin-top: 16px;">
        <button class="btn" type="submit">Guardar</button>
        <a class="btn secondary" href="/?controller=talla">Cancelar</a>
    </div>
</form>
