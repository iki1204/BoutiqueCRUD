<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form method="post" class="row g-3" action="index.php?route=proveedores">
      <input type="hidden" name="accion" value="<?= $edit ? 'actualizar' : 'crear' ?>">
      <div class="col-md-2">
        <label class="form-label">ID</label>
        <input type="number" name="PROVEEDOR_ID" class="form-control" required value="<?= h($edit['PROVEEDOR_ID'] ?? '') ?>" <?= $edit ? 'readonly' : '' ?>>
      </div>
      <div class="col-md-4">
        <label class="form-label">Empresa</label>
        <input type="text" name="NOMBRE_EMPRESA" class="form-control" required value="<?= h($edit['NOMBRE_EMPRESA'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="TELEFONO" class="form-control" value="<?= h($edit['TELEFONO'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">Email</label>
        <input type="email" name="EMAIL" class="form-control" value="<?= h($edit['EMAIL'] ?? '') ?>">
      </div>
      <div class="col-md-8">
        <label class="form-label">Dirección</label>
        <input type="text" name="DIRECCION" class="form-control" value="<?= h($edit['DIRECCION'] ?? '') ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Ciudad</label>
        <input type="text" name="CIUDAD" class="form-control" value="<?= h($edit['CIUDAD'] ?? '') ?>">
      </div>
      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary" type="submit"><?= $edit ? 'Actualizar' : 'Crear' ?></button>
        <?php if ($edit): ?><a class="btn btn-secondary" href="index.php?route=proveedores">Cancelar</a><?php endif; ?>
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
            <th>ID</th><th>Empresa</th><th>Teléfono</th><th>Email</th><th>Dirección</th><th>Ciudad</th><th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td><?= h($r['PROVEEDOR_ID']) ?></td>
              <td><?= h($r['NOMBRE_EMPRESA']) ?></td>
              <td><?= h($r['TELEFONO']) ?></td>
              <td><?= h($r['EMAIL']) ?></td>
              <td><?= h($r['DIRECCION']) ?></td>
              <td><?= h($r['CIUDAD']) ?></td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary" href="index.php?route=proveedores&edit=<?= h($r['PROVEEDOR_ID']) ?>">Editar</a>
                <form method="post" class="d-inline" action="index.php?route=proveedores" onsubmit="return confirm('¿Eliminar este proveedor?');">
                  <input type="hidden" name="accion" value="eliminar">
                  <input type="hidden" name="PROVEEDOR_ID" value="<?= h($r['PROVEEDOR_ID']) ?>">
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
