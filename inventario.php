<?php
require_once __DIR__ . '/consultas.php';

$productos = get_options('PRODUCTO','PRODUCTO_ID','NOMBRE');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    try {
        if ($accion === 'crear') {
            $id = (int)($_POST['INVENTARIO_ID'] ?? 0);
            $producto_id = (int)($_POST['PRODUCTO_ID'] ?? 0);
            $talla = trim($_POST['TALLA'] ?? '');
            $color = trim($_POST['COLOR'] ?? '');
            $stock = (int)($_POST['STOCK'] ?? 0);
            $precio = (float)($_POST['PRECIO'] ?? 0);
            $stmt = $conn->prepare('INSERT INTO INVENTARIO (INVENTARIO_ID, PRODUCTO_ID, TALLA, COLOR, STOCK, PRECIO) VALUES (?,?,?,?,?,?)');
            $stmt->bind_param('iissid', $id, $producto_id, $talla, $color, $stock, $precio);
            $stmt->execute();
            flash_set('success', 'Inventario creado.');
        } elseif ($accion === 'actualizar') {
            $id = (int)($_POST['INVENTARIO_ID'] ?? 0);
            $producto_id = (int)($_POST['PRODUCTO_ID'] ?? 0);
            $talla = trim($_POST['TALLA'] ?? '');
            $color = trim($_POST['COLOR'] ?? '');
            $stock = (int)($_POST['STOCK'] ?? 0);
            $precio = (float)($_POST['PRECIO'] ?? 0);
            $stmt = $conn->prepare('UPDATE INVENTARIO SET PRODUCTO_ID=?, TALLA=?, COLOR=?, STOCK=?, PRECIO=? WHERE INVENTARIO_ID=?');
            $stmt->bind_param('issidi', $producto_id, $talla, $color, $stock, $precio, $id);
            $stmt->execute();
            flash_set('success', 'Inventario actualizado.');
        } elseif ($accion === 'eliminar') {
            $id = (int)($_POST['INVENTARIO_ID'] ?? 0);
            $stmt = $conn->prepare('DELETE FROM INVENTARIO WHERE INVENTARIO_ID=?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            flash_set('warning', 'Inventario eliminado.');
        }
    } catch (mysqli_sql_exception $e) {
        flash_set('danger', 'Error: ' . $e->getMessage());
    }
    redirect('inventario.php');
}

$edit = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $conn->prepare('SELECT * FROM INVENTARIO WHERE INVENTARIO_ID=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $edit = $stmt->get_result()->fetch_assoc() ?: null;
}

$stmt = $conn->prepare('SELECT i.*, p.NOMBRE AS PRODUCTO
                        FROM INVENTARIO i
                        LEFT JOIN PRODUCTO p ON p.PRODUCTO_ID = i.PRODUCTO_ID
                        ORDER BY i.INVENTARIO_ID DESC');
$stmt->execute();
$rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

page_header('Inventario');
?>

<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form method="post" class="row g-3">
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
        <?php if ($edit): ?><a class="btn btn-secondary" href="inventario.php">Cancelar</a><?php endif; ?>
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
                <a class="btn btn-sm btn-outline-primary" href="inventario.php?edit=<?= h($r['INVENTARIO_ID']) ?>">Editar</a>
                <form method="post" class="d-inline" onsubmit="return confirm('¿Eliminar este registro de inventario?');">
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

<?php page_footer();
