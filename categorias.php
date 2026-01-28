<?php
require_once __DIR__ . '/consultas.php';

// CRUD handlers
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    try {
        if ($accion === 'crear') {
            $id = (int)($_POST['CATEGORIA_ID'] ?? 0);
            $nombre = trim($_POST['NOMBRE'] ?? '');
            $desc = trim($_POST['DESCRIPCION'] ?? '');
            $stmt = $conn->prepare('INSERT INTO CATEGORIA (CATEGORIA_ID, NOMBRE, DESCRIPCION) VALUES (?,?,?)');
            $stmt->bind_param('iss', $id, $nombre, $desc);
            $stmt->execute();
            flash_set('success', 'Categoría creada.');
        } elseif ($accion === 'actualizar') {
            $id = (int)($_POST['CATEGORIA_ID'] ?? 0);
            $nombre = trim($_POST['NOMBRE'] ?? '');
            $desc = trim($_POST['DESCRIPCION'] ?? '');
            $stmt = $conn->prepare('UPDATE CATEGORIA SET NOMBRE=?, DESCRIPCION=? WHERE CATEGORIA_ID=?');
            $stmt->bind_param('ssi', $nombre, $desc, $id);
            $stmt->execute();
            flash_set('success', 'Categoría actualizada.');
        } elseif ($accion === 'eliminar') {
            $id = (int)($_POST['CATEGORIA_ID'] ?? 0);
            $stmt = $conn->prepare('DELETE FROM CATEGORIA WHERE CATEGORIA_ID=?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            flash_set('warning', 'Categoría eliminada.');
        }
    } catch (mysqli_sql_exception $e) {
        flash_set('danger', 'Error: ' . $e->getMessage());
    }
    redirect('categorias.php');
}

// Edit mode
$edit = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $conn->prepare('SELECT * FROM CATEGORIA WHERE CATEGORIA_ID=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $edit = $stmt->get_result()->fetch_assoc() ?: null;
}

// List
$stmt = $conn->prepare('SELECT * FROM CATEGORIA ORDER BY CATEGORIA_ID DESC');
$stmt->execute();
$rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

page_header('Categorías');
?>

<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form method="post" class="row g-3">
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
          <a class="btn btn-secondary" href="categorias.php">Cancelar</a>
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
                <a class="btn btn-sm btn-outline-primary" href="categorias.php?edit=<?= h($r['CATEGORIA_ID']) ?>">Editar</a>
                <form method="post" class="d-inline" onsubmit="return confirm('¿Eliminar esta categoría?');">
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

<?php page_footer();
