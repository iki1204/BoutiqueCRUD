<?php
require_once __DIR__ . '/consultas.php';

$clientes = get_options('CLIENTE','CLIENTE_ID','NOMBRE');
$productos = get_options('PRODUCTO','PRODUCTO_ID','NOMBRE');
$empleados = get_options('EMPLEADO','EMPLEADO_ID','NOMBRE');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    try {
        if ($accion === 'crear') {
            $id = (int)($_POST['VENTA_ID'] ?? 0);
            $cliente_id = (int)($_POST['CLIENTE_ID'] ?? 0);
            $empleado_id = (int)($_POST['EMPLEADO_ID'] ?? 0);
            $fecha = trim($_POST['FECHA'] ?? '');
            $fecha_db = $fecha ? date('Y-m-d H:i:s', strtotime($fecha)) : null;
            $total = (float)($_POST['TOTAL'] ?? 0);
            $metodo = trim($_POST['METODO_PAGO'] ?? '');
            

            $stmt = $conn->prepare('INSERT INTO VENTAS (VENTA_ID, CLIENTE_ID, EMPLEADO_ID, FECHA, TOTAL, METODO_PAGO) VALUES (?,?,?,?,?,?)');
            $stmt->bind_param('iiisds', $id, $cliente_id, $empleado_id, $fecha_db, $total, $metodo);



            $stmt->execute();
            flash_set('success', 'Venta creada.');
        } elseif ($accion === 'actualizar') {
            $id = (int)($_POST['VENTA_ID'] ?? 0);
            $cliente_id = (int)($_POST['CLIENTE_ID'] ?? 0);
            $empleado_id = (int)($_POST['EMPLEADO_ID'] ?? 0);
            $fecha = trim($_POST['FECHA'] ?? '');
            $fecha_db = $fecha ? date('Y-m-d H:i:s', strtotime($fecha)) : null;
            $total = (float)($_POST['TOTAL'] ?? 0);
            $metodo = trim($_POST['METODO_PAGO'] ?? '');

            $stmt = $conn->prepare('UPDATE VENTAS SET CLIENTE_ID=?, EMPLEADO_ID=?, FECHA=?, TOTAL=?, METODO_PAGO=? WHERE VENTA_ID=?');
            $stmt->bind_param('iisdsi', $cliente_id, $empleado_id, $fecha_db, $total, $metodo, $id);
            $stmt->execute();
            flash_set('success', 'Venta actualizada.');
        } elseif ($accion === 'eliminar') {
            $id = (int)($_POST['VENTA_ID'] ?? 0);
            $stmt = $conn->prepare('DELETE FROM VENTAS WHERE VENTA_ID=?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            flash_set('warning', 'Venta eliminada.');
        }
    } catch (mysqli_sql_exception $e) {
        flash_set('danger', 'Error: ' . $e->getMessage());
    }
    redirect('ventas.php');
}

$edit = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $conn->prepare('SELECT * FROM VENTAS WHERE VENTA_ID=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $edit = $stmt->get_result()->fetch_assoc() ?: null;
}

$stmt = $conn->prepare('SELECT v.*, dv.*, c.NOMBRE AS CLIENTE, e.NOMBRE AS EMPLEADO , i.INVENTARIO_ID AS INVENTARIO, p.NOMBRE AS PRODUCTO
                        FROM VENTAS v
                        LEFT JOIN CLIENTE c ON c.CLIENTE_ID = v.CLIENTE_ID
                        LEFT JOIN EMPLEADO e ON e.EMPLEADO_ID = v.EMPLEADO_ID
                        INNER JOIN DETALLE_VENTA dv ON dv.VENTA_ID = v.VENTA_ID
                        INNER JOIN INVENTARIO i ON i.INVENTARIO_ID = dv.INVENTARIO_ID
                        INNER JOIN PRODUCTO p ON p.PRODUCTO_ID = i.PRODUCTO_ID
                        ORDER BY v.VENTA_ID DESC, dv.DETALLE_ID ASC');
$stmt->execute();
$rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

page_header('Ventas');
?>

<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form method="post" class="row g-3">
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
        <?php if ($edit): ?><a class="btn btn-secondary" href="ventas.php">Cancelar</a><?php endif; ?>
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
                <a class="btn btn-sm btn-outline-primary" href="ventas.php?edit=<?= h($r['VENTA_ID']) ?>">Editar</a>
                <form method="post" class="d-inline" onsubmit="return confirm('¿Eliminar esta venta?');">
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

<?php page_footer();
