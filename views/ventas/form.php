<h1><?= $venta ? 'Editar venta' : 'Nueva venta' ?></h1>
<form method="post" action="<?= htmlspecialchars($action) ?>">
    <div class="form-grid">
        <div>
            <label for="CLIENTE_ID">Cliente</label>
            <select id="CLIENTE_ID" name="CLIENTE_ID" required>
                <option value="">Selecciona</option>
                <?php foreach ($clientes as $cliente) : ?>
                    <option value="<?= (int) $cliente['CLIENTE_ID'] ?>" <?= ($venta && (int) $venta['CLIENTE_ID'] === (int) $cliente['CLIENTE_ID']) ? 'selected' : '' ?> >
                        <?= htmlspecialchars((string) ($cliente['APELLIDO'] ?? $cliente['CODIGO'] ?? '')) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="EMPLEADO_ID">Empleado</label>
            <select id="EMPLEADO_ID" name="EMPLEADO_ID" required>
                <option value="">Selecciona</option>
                <?php foreach ($empleados as $empleado) : ?>
                    <option value="<?= (int) $empleado['EMPLEADO_ID'] ?>" <?= ($venta && (int) $venta['EMPLEADO_ID'] === (int) $empleado['EMPLEADO_ID']) ? 'selected' : '' ?> >
                        <?= htmlspecialchars((string) ($empleado['APELLIDO'] ?? $empleado['CODIGO'] ?? '')) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="FECHA">Fecha</label>
            <input type="datetime-local" id="FECHA" name="FECHA" value="<?= htmlspecialchars($venta ? date('Y-m-d\TH:i', strtotime((string) $venta['FECHA'])) : date('Y-m-d\TH:i')) ?>">
        </div>
        <div>
            <label for="ESTADO">Estado</label>
            <input type="text" id="ESTADO" name="ESTADO" value="<?= htmlspecialchars((string) ($venta['ESTADO'] ?? 'Pendiente')) ?>">
        </div>
        <div>
            <label for="METODO_PAGO">Método de pago</label>
            <input type="text" id="METODO_PAGO" name="METODO_PAGO" value="<?= htmlspecialchars((string) ($venta['METODO_PAGO'] ?? '')) ?>">
        </div>
    </div>

    <h2 class="section-title">Detalle de venta</h2>
    <p class="notice">Una venta se crea una vez y luego se agregan N líneas de detalle.</p>
    <div id="detalle-container">
        <?php if (!empty($detalles)) : ?>
            <?php foreach ($detalles as $detalle) : ?>
                <div class="detail-row">
                    <div>
                        <label>Producto</label>
                        <select name="DETALLE_PRODUCTO_ID[]" required>
                            <option value="">Selecciona</option>
                            <?php foreach ($productos as $producto) : ?>
                                <option value="<?= (int) $producto['PRODUCTO_ID'] ?>" <?= (int) $detalle['PRODUCTO_ID'] === (int) $producto['PRODUCTO_ID'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars((string) ($producto['DESCRIPCION'] ?? $producto['CODIGO'] ?? '')) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label>Cantidad</label>
                        <input type="number" min="1" name="DETALLE_CANTIDAD[]" value="<?= htmlspecialchars((string) ($detalle['CANTIDAD'] ?? 1)) ?>" required>
                    </div>
                    <div>
                        <label>Precio</label>
                        <input type="number" min="0" step="0.01" name="DETALLE_PRECIO[]" value="<?= htmlspecialchars((string) ($detalle['PRECIO'] ?? 0)) ?>" required>
                    </div>
                    <button class="btn danger" type="button" onclick="removeDetalle(this)">Quitar</button>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="detail-row">
                <div>
                    <label>Producto</label>
                    <select name="DETALLE_PRODUCTO_ID[]" required>
                        <option value="">Selecciona</option>
                        <?php foreach ($productos as $producto) : ?>
                            <option value="<?= (int) $producto['PRODUCTO_ID'] ?>">
                                <?= htmlspecialchars((string) ($producto['DESCRIPCION'] ?? $producto['CODIGO'] ?? '')) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label>Cantidad</label>
                    <input type="number" min="1" name="DETALLE_CANTIDAD[]" value="1" required>
                </div>
                <div>
                    <label>Precio</label>
                    <input type="number" min="0" step="0.01" name="DETALLE_PRECIO[]" value="0" required>
                </div>
                <button class="btn danger" type="button" onclick="removeDetalle(this)">Quitar</button>
            </div>
        <?php endif; ?>
    </div>

    <div class="actions" style="margin-top: 16px;">
        <button class="btn secondary" type="button" onclick="addDetalle()">Agregar línea</button>
    </div>

    <div class="actions" style="margin-top: 24px;">
        <button class="btn" type="submit">Guardar venta</button>
        <a class="btn secondary" href="/ventas">Cancelar</a>
    </div>
</form>

<script>
    function addDetalle() {
        const container = document.getElementById('detalle-container');
        const row = document.createElement('div');
        row.className = 'detail-row';
        row.innerHTML = `
            <div>
                <label>Producto</label>
                <select name="DETALLE_PRODUCTO_ID[]" required>
                    <option value="">Selecciona</option>
                    <?php foreach ($productos as $producto) : ?>
                        <option value="<?= (int) $producto['PRODUCTO_ID'] ?>">
                            <?= htmlspecialchars((string) ($producto['DESCRIPCION'] ?? $producto['CODIGO'] ?? '')) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label>Cantidad</label>
                <input type="number" min="1" name="DETALLE_CANTIDAD[]" value="1" required>
            </div>
            <div>
                <label>Precio</label>
                <input type="number" min="0" step="0.01" name="DETALLE_PRECIO[]" value="0" required>
            </div>
            <button class="btn danger" type="button" onclick="removeDetalle(this)">Quitar</button>
        `;
        container.appendChild(row);
    }

    function removeDetalle(button) {
        const row = button.closest('.detail-row');
        if (!row) {
            return;
        }
        const container = document.getElementById('detalle-container');
        if (container.children.length > 1) {
            row.remove();
        }
    }
</script>
