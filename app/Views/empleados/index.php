<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form method="post" class="row g-3" action="index.php?route=empleados">
      <input type="hidden" name="accion" value="<?= $edit ? 'actualizar' : 'crear' ?>">
      <div class="col-md-2">
        <label class="form-label">ID</label>
        <input type="number" name="EMPLEADO_ID" class="form-control" required value="<?= h($edit['EMPLEADO_ID'] ?? '') ?>" <?= $edit ? 'readonly' : '' ?>>
      </div>
      <div class="col-md-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="NOMBRE" class="form-control" required value="<?= h($edit['NOMBRE'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">Apellido</label>
        <input type="text" name="APELLIDO" class="form-control" required value="<?= h($edit['APELLIDO'] ?? '') ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Cargo</label>
        <input type="text" name="CARGO" class="form-control" value="<?= h($edit['CARGO'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="TELEFONO" class="form-control" value="<?= h($edit['TELEFONO'] ?? '') ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">Dirección</label>
        <input type="text" name="DIRECCION" class="form-control" value="<?= h($edit['DIRECCION'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">Fecha ingreso</label>
        <input type="datetime-local" name="FECHA_INGRESO" class="form-control" value="<?= h(isset($edit['FECHA_INGRESO']) && $edit['FECHA_INGRESO'] ? date('Y-m-d\TH:i', strtotime($edit['FECHA_INGRESO'])) : '') ?>">
      </div>

      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary" type="submit"><?= $edit ? 'Actualizar' : 'Crear' ?></button>
        <?php if ($edit): ?><a class="btn btn-secondary" href="index.php?route=empleados">Cancelar</a><?php endif; ?>
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
            <th>ID</th><th>Nombre</th><th>Apellido</th><th>Cargo</th><th>Teléfono</th><th>Dirección</th><th>Fecha ingreso</th><th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td><?= h($r['EMPLEADO_ID']) ?></td>
              <td><?= h($r['NOMBRE']) ?></td>
              <td><?= h($r['APELLIDO']) ?></td>
              <td><?= h($r['CARGO']) ?></td>
              <td><?= h($r['TELEFONO']) ?></td>
              <td><?= h($r['DIRECCION']) ?></td>
              <td><?= h($r['FECHA_INGRESO']) ?></td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary" href="index.php?route=empleados&edit=<?= h($r['EMPLEADO_ID']) ?>">Editar</a>
                <form method="post" class="d-inline" action="index.php?route=empleados" onsubmit="return confirm('¿Eliminar este empleado?');">
                  <input type="hidden" name="accion" value="eliminar">
                  <input type="hidden" name="EMPLEADO_ID" value="<?= h($r['EMPLEADO_ID']) ?>">
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
