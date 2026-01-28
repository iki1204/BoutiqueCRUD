<?php
require_once __DIR__ . '/consultas.php';

$categorias = get_options('CATEGORIA','CATEGORIA_ID','NOMBRE');
$proveedores = get_options('PROVEEDOR','PROVEEDOR_ID','NOMBRE_EMPRESA');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    try {
        if ($accion === 'crear') {
            $id = (int)($_POST['PRODUCTO_ID'] ?? 0);
            $categoria_id = (int)($_POST['CATEGORIA_ID'] ?? 0);
            $proveedor_id = (int)($_POST['PROVEEDOR_ID'] ?? 0);
            $nombre = trim($_POST['NOMBRE'] ?? '');
            $desc = trim($_POST['DESCRIPCION'] ?? '');
            $color = trim($_POST['COLOR'] ?? '');
            $marca = trim($_POST['MARCA'] ?? '');
            $stmt = $conn->prepare('INSERT INTO PRODUCTO (PRODUCTO_ID, CATEGORIA_ID, PROVEEDOR_ID, NOMBRE, DESCRIPCION, COLOR, MARCA) VALUES (?,?,?,?,?,?,?)');
            $stmt->bind_param('iiissss', $id, $categoria_id, $proveedor_id, $nombre, $desc, $color, $marca);
            $stmt->execute();
            flash_set('success', 'Producto creado.');
        } elseif ($accion === 'actualizar') {
            $id = (int)($_POST['PRODUCTO_ID'] ?? 0);
            $categoria_id = (int)($_POST['CATEGORIA_ID'] ?? 0);
            $proveedor_id = (int)($_POST['PROVEEDOR_ID'] ?? 0);
            $nombre = trim($_POST['NOMBRE'] ?? '');
            $desc = trim($_POST['DESCRIPCION'] ?? '');
            $color = trim($_POST['COLOR'] ?? '');
            $marca = trim($_POST['MARCA'] ?? '');
            $stmt = $conn->prepare('UPDATE PRODUCTO SET CATEGORIA_ID=?, PROVEEDOR_ID=?, NOMBRE=?, DESCRIPCION=?, COLOR=?, MARCA=? WHERE PRODUCTO_ID=?');
            $stmt->bind_param('iissssi', $categoria_id, $proveedor_id, $nombre, $desc, $color, $marca, $id);
            $stmt->execute();
            flash_set('success', 'Producto actualizado.');
        } elseif ($accion === 'eliminar') {
            $id = (int)($_POST['PRODUCTO_ID'] ?? 0);
            $stmt = $conn->prepare('DELETE FROM PRODUCTO WHERE PRODUCTO_ID=?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            flash_set('warning', 'Producto eliminado.');
        }
    } catch (mysqli_sql_exception $e) {
        flash_set('danger', 'Error: ' . $e->getMessage());
    }
    redirect('productos.php');
}

$edit = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $conn->prepare('SELECT * FROM PRODUCTO WHERE PRODUCTO_ID=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $edit = $stmt->get_result()->fetch_assoc() ?: null;
}

$stmt = $conn->prepare('SELECT p.*, c.NOMBRE AS CATEGORIA, pr.NOMBRE_EMPRESA AS PROVEEDOR
                        FROM PRODUCTO p
                        LEFT JOIN CATEGORIA c ON c.CATEGORIA_ID = p.CATEGORIA_ID
                        LEFT JOIN PROVEEDOR pr ON pr.PROVEEDOR_ID = p.PROVEEDOR_ID
                        ORDER BY p.PRODUCTO_ID DESC');
$stmt->execute();
$rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

page_header('Productos');
?>

<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form method="post" class="row g-3">
      <input type="hidden" name="accion" value="<?= $edit ? 'actualizar' : 'crear' ?>">
      <div class="col-md-2">
        <label class="form-label">ID</label>
        <input type="number" name="PRODUCTO_ID" class="form-control" required value="<?= h($edit['PRODUCTO_ID'] ?? '') ?>" <?= $edit ? 'readonly' : '' ?>>
      </div>
      <div class="col-md-4">
        <label class="form-label">Nombre</label>
        <input type="text" name="NOMBRE" class="form-control" required value="<?= h($edit['NOMBRE'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">Categoría</label>
        <select name="CATEGORIA_ID" class="form-select" required>
          <option value="">Seleccione...</option>
          <?php foreach ($categorias as $c): ?>
            <option value="<?= h($c['id']) ?>" <?= (string)($edit['CATEGORIA_ID'] ?? '') === (string)$c['id'] ? 'selected' : '' ?>><?= h($c['label']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">Proveedor</label>
        <select name="PROVEEDOR_ID" class="form-select" required>
          <option value="">Seleccione...</option>
          <?php foreach ($proveedores as $p): ?>
            <option value="<?= h($p['id']) ?>" <?= (string)($edit['PROVEEDOR_ID'] ?? '') === (string)$p['id'] ? 'selected' : '' ?>><?= h($p['label']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Descripción</label>
        <input type="text" name="DESCRIPCION" class="form-control" value="<?= h($edit['DESCRIPCION'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">Color</label>
        <input type="text" name="COLOR" class="form-control" value="<?= h($edit['COLOR'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">Marca</label>
        <input type="text" name="MARCA" class="form-control" value="<?= h($edit['MARCA'] ?? '') ?>">
      </div>

      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary" type="submit"><?= $edit ? 'Actualizar' : 'Crear' ?></button>
        <?php if ($edit): ?><a class="btn btn-secondary" href="productos.php">Cancelar</a><?php endif; ?>
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
            <th>ID</th><th>Nombre</th><th>Categoría</th><th>Proveedor</th><th>Color</th><th>Marca</th><th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td><?= h($r['PRODUCTO_ID']) ?></td>
              <td><?= h($r['NOMBRE']) ?></td>
              <td><?= h($r['CATEGORIA']) ?></td>
              <td><?= h($r['PROVEEDOR']) ?></td>
              <td><?= h($r['COLOR']) ?></td>
              <td><?= h($r['MARCA']) ?></td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary" href="productos.php?edit=<?= h($r['PRODUCTO_ID']) ?>">Editar</a>
                <form method="post" class="d-inline" onsubmit="return confirm('¿Eliminar este producto?');">
                  <input type="hidden" name="accion" value="eliminar">
                  <input type="hidden" name="PRODUCTO_ID" value="<?= h($r['PRODUCTO_ID']) ?>">
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
