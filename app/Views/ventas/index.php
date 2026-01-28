<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form method="post" class="row g-3" action="index.php?route=ventas">
      <input type="hidden" name="accion" value="<?= $edit ? 'actualizar' : 'crear' ?>">
      <div class="col-md-2">
        <label class="form-label">ID</label>
        <input type="number" name="VENTA_ID" class="form-control" required value="<?= h($edit['VENTA_ID'] ?? '') ?>" <?= $edit ? 'readonly' : '' ?>>
      </div>
      <div class="col-md-4">
        <label class="form-label">Cliente</label>
        <select name="CLIENTE_ID" class="form-select" required>
          <option value="">Seleccione...</option>
          <?php foreach ($clientes as $c): ?>
            <option value="<?= h($c['id']) ?>" <?= (string)($edit['CLIENTE_ID'] ?? '') === (string)$c['id'] ? 'selected' : '' ?>><?= h($c['label']) ?> (ID <?= h($c['id']) ?>)</option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Producto</label>
        <select name="PRODUCTO_ID" class="form-select" required>
          <option value="">Seleccione...</option>
          <?php foreach ($productos as $p): ?>
            <option value="<?= h($p['id']) ?>" <?= (string)($edit['PRODUCTO_ID'] ?? '') === (string)$p['id'] ? 'selected' : '' ?>><?= h($p['label']) ?> (ID <?= h($p['id']) ?>)</option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Empleado</label>
        <select name="EMPLEADO_ID" class="form-select" required>
          <option value="">Seleccione...</option>
          <?php foreach ($empleados as $e): ?>
            <option value="<?= h($e['id']) ?>" <?= (string)($edit['EMPLEADO_ID'] ?? '') === (string)$e['id'] ? 'selected' : '' ?>><?= h($e['label']) ?> (ID <?= h($e['id']) ?>)</option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-2">
        <label class="form-label">Fecha</label>
        <input type="datetime-local" name="FECHA" class="form-control" value="<?= h(isset($edit['FECHA']) && $edit['FECHA'] ? date('Y-m-d\TH:i', strtotime($edit['FECHA'])) : '') ?>">
      </div>
      <div class="col-md-2">
        <label class="form-label">Total</label>
        <input type="number" step="0.01" name="TOTAL" class="form-control" value="<?= h($edit['TOTAL'] ?? '') ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Método de pago</label>
        <input type="text" name="METODO_PAGO" class="form-control" value="<?= h($edit['METODO_PAGO'] ?? '') ?>">
      </div>
      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary" type="submit"><?= $edit ? 'Actualizar' : 'Crear' ?></button>
        <?php if ($edit): ?><a class="btn btn-secondary" href="index.php?route=ventas">Cancelar</a><?php endif; ?>
      </div>
    </form>
  </div>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>ID</th><th>Cliente</th><th>Empleado</th><th>Fecha</th><th>Producto</th><th>Tipo</th><th>Total</th><th>Método</th><th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td><?= h($r['VENTA_ID']) ?></td>
              <td><?= h($r['CLIENTE']) ?></td>
              <td><?= h($r['EMPLEADO']) ?></td>
              <td><?= h($r['FECHA']) ?></td>
              <td><?= h($r['PRODUCTO']) ?></td>
              <td><?= h($r['INVENTARIO_ID']) ?></td>
              <td><?= h($r['TOTAL']) ?></td>
              <td><?= h($r['METODO_PAGO']) ?></td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary" href="index.php?route=ventas&edit=<?= h($r['VENTA_ID']) ?>">Editar</a>
                <form method="post" class="d-inline" action="index.php?route=ventas" onsubmit="return confirm('¿Eliminar esta venta?');">
                  <input type="hidden" name="accion" value="eliminar">
                  <input type="hidden" name="VENTA_ID" value="<?= h($r['VENTA_ID']) ?>">
                  <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
