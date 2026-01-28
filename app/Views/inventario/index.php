<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form method="post" class="row g-3" action="index.php?route=inventario">
      <input type="hidden" name="accion" value="<?= $edit ? 'actualizar' : 'crear' ?>">
      <div class="col-md-2">
        <label class="form-label">ID</label>
        <input type="number" name="INVENTARIO_ID" class="form-control" required value="<?= h($edit['INVENTARIO_ID'] ?? '') ?>" <?= $edit ? 'readonly' : '' ?>>
      </div>
      <div class="col-md-4">
        <label class="form-label">Producto</label>
        <select name="PRODUCTO_ID" class="form-select" required>
          <option value="">Seleccione...</option>
          <?php foreach ($productos as $p): ?>
            <option value="<?= h($p['id']) ?>" <?= (string)($edit['PRODUCTO_ID'] ?? '') === (string)$p['id'] ? 'selected' : '' ?>><?= h($p['label']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-2">
        <label class="form-label">Talla</label>
        <input type="text" name="TALLA" class="form-control" value="<?= h($edit['TALLA'] ?? '') ?>">
      </div>
      <div class="col-md-2">
        <label class="form-label">Color</label>
        <input type="text" name="COLOR" class="form-control" value="<?= h($edit['COLOR'] ?? '') ?>">
      </div>
      <div class="col-md-2">
        <label class="form-label">Stock</label>
        <input type="number" name="STOCK" class="form-control" value="<?= h($edit['STOCK'] ?? '') ?>">
      </div>
      <div class="col-md-2">
        <label class="form-label">Precio</label>
        <input type="number" step="0.01" name="PRECIO" class="form-control" value="<?= h($edit['PRECIO'] ?? '') ?>">
      </div>

      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary" type="submit"><?= $edit ? 'Actualizar' : 'Crear' ?></button>
        <?php if ($edit): ?><a class="btn btn-secondary" href="index.php?route=inventario">Cancelar</a><?php endif; ?>
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
            <th>ID</th><th>Producto</th><th>Talla</th><th>Color</th><th>Stock</th><th>Precio</th><th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td><?= h($r['INVENTARIO_ID']) ?></td>
              <td><?= h($r['PRODUCTO']) ?></td>
              <td><?= h($r['TALLA']) ?></td>
              <td><?= h($r['COLOR']) ?></td>
              <td><?= h($r['STOCK']) ?></td>
              <td><?= h($r['PRECIO']) ?></td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary" href="index.php?route=inventario&edit=<?= h($r['INVENTARIO_ID']) ?>">Editar</a>
                <form method="post" class="d-inline" action="index.php?route=inventario" onsubmit="return confirm('¿Eliminar este registro de inventario?');">
                  <input type="hidden" name="accion" value="eliminar">
                  <input type="hidden" name="INVENTARIO_ID" value="<?= h($r['INVENTARIO_ID']) ?>">
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
