<h1><?= htmlspecialchars($title) ?></h1>
<form method="post" action="<?= htmlspecialchars($action) ?>">
    <div class="form-grid">
        <div>
            <label for="EMPLEADO_ID">ID</label>
            <input type="number" id="EMPLEADO_ID" name="EMPLEADO_ID" value="<?= htmlspecialchars((string) ($empleado['EMPLEADO_ID'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="CODIGO">Código</label>
            <input type="text" id="CODIGO" name="CODIGO" value="<?= htmlspecialchars((string) ($empleado['CODIGO'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="APELLIDO">Apellido</label>
            <input type="text" id="APELLIDO" name="APELLIDO" value="<?= htmlspecialchars((string) ($empleado['APELLIDO'] ?? '')) ?>" required>
        </div>
        <div>
            <label for="CARGO">Cargo</label>
            <input type="text" id="CARGO" name="CARGO" value="<?= htmlspecialchars((string) ($empleado['CARGO'] ?? '')) ?>">
        </div>
        <div>
            <label for="TELEFONO">Teléfono</label>
            <input type="text" id="TELEFONO" name="TELEFONO" value="<?= htmlspecialchars((string) ($empleado['TELEFONO'] ?? '')) ?>">
        </div>
        <div>
            <label for="DIRECCION">Dirección</label>
            <input type="text" id="DIRECCION" name="DIRECCION" value="<?= htmlspecialchars((string) ($empleado['DIRECCION'] ?? '')) ?>">
        </div>
        <div>
            <label for="FECHA_INGRESO">Fecha ingreso</label>
            <input type="datetime-local" id="FECHA_INGRESO" name="FECHA_INGRESO" value="<?= htmlspecialchars($empleado ? date('Y-m-d\\TH:i', strtotime((string) $empleado['FECHA_INGRESO'])) : '') ?>">
        </div>
    </div>
    <div class="actions" style="margin-top: 16px;">
        <button class="btn" type="submit">Guardar</button>
        <a class="btn secondary" href="/?controller=empleado">Cancelar</a>
    </div>
</form>
