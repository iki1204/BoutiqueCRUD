<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form method="post" class="row g-3" action="index.php?route=categorias">
      <input type="hidden" name="accion" value="<?= $edit ? 'actualizar' : 'crear' ?>">
      <div class="col-md-2">
        <label class="form-label">ID</label>
        <input type="number" name="CATEGORIA_ID" class="form-control" required value="<?= h($edit['CATEGORIA_ID'] ?? '') ?>" <?= $edit ? 'readonly' : '' ?>>
      </div>
      <div class="col-md-4">
        <label class="form-label">Nombre</label>
        <input type="text" name="NOMBRE" class="form-control" required value="<?= h($edit['NOMBRE'] ?? '') ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">Descripción</label>
        <input type="text" name="DESCRIPCION" class="form-control" value="<?= h($edit['DESCRIPCION'] ?? '') ?>">
      </div>
      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary" type="submit"><?= $edit ? 'Actualizar' : 'Crear' ?></button>
        <?php if ($edit): ?>
          <a class="btn btn-secondary" href="index.php?route=categorias">Cancelar</a>
        <?php endif; ?>
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
            <th>ID</th><th>Nombre</th><th>Descripción</th><th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td><?= h($r['CATEGORIA_ID']) ?></td>
              <td><?= h($r['NOMBRE']) ?></td>
              <td><?= h($r['DESCRIPCION']) ?></td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary" href="index.php?route=categorias&edit=<?= h($r['CATEGORIA_ID']) ?>">Editar</a>
                <form method="post" class="d-inline" action="index.php?route=categorias" onsubmit="return confirm('¿Eliminar esta categoría?');">
                  <input type="hidden" name="accion" value="eliminar">
                  <input type="hidden" name="CATEGORIA_ID" value="<?= h($r['CATEGORIA_ID']) ?>">
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
