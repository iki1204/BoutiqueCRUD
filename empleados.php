<?php
require_once __DIR__ . '/consultas.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    try {
        if ($accion === 'crear') {
            $id = (int)($_POST['EMPLEADO_ID'] ?? 0);
            $nombre = trim($_POST['NOMBRE'] ?? '');
            $apellido = trim($_POST['APELLIDO'] ?? '');
            $cargo = trim($_POST['CARGO'] ?? '');
            $telefono = trim($_POST['TELEFONO'] ?? '');
            $direccion = trim($_POST['DIRECCION'] ?? '');
            $fecha = trim($_POST['FECHA_INGRESO'] ?? '');
            $fecha_db = $fecha ? date('Y-m-d H:i:s', strtotime($fecha)) : null;

            $stmt = $conn->prepare('INSERT INTO EMPLEADO (EMPLEADO_ID, NOMBRE, APELLIDO, CARGO, TELEFONO, DIRECCION, FECHA_INGRESO) VALUES (?,?,?,?,?,?,?)');
            $stmt->bind_param('issssss', $id, $nombre, $apellido, $cargo, $telefono, $direccion, $fecha_db);
            $stmt->execute();
            flash_set('success', 'Empleado creado.');
        } elseif ($accion === 'actualizar') {
            $id = (int)($_POST['EMPLEADO_ID'] ?? 0);
            $nombre = trim($_POST['NOMBRE'] ?? '');
            $apellido = trim($_POST['APELLIDO'] ?? '');
            $cargo = trim($_POST['CARGO'] ?? '');
            $telefono = trim($_POST['TELEFONO'] ?? '');
            $direccion = trim($_POST['DIRECCION'] ?? '');
            $fecha = trim($_POST['FECHA_INGRESO'] ?? '');
            $fecha_db = $fecha ? date('Y-m-d H:i:s', strtotime($fecha)) : null;

            $stmt = $conn->prepare('UPDATE EMPLEADO SET NOMBRE=?, APELLIDO=?, CARGO=?, TELEFONO=?, DIRECCION=?, FECHA_INGRESO=? WHERE EMPLEADO_ID=?');
            $stmt->bind_param('ssssssi', $nombre, $apellido, $cargo, $telefono, $direccion, $fecha_db, $id);
            $stmt->execute();
            flash_set('success', 'Empleado actualizado.');
        } elseif ($accion === 'eliminar') {
            $id = (int)($_POST['EMPLEADO_ID'] ?? 0);
            $stmt = $conn->prepare('DELETE FROM EMPLEADO WHERE EMPLEADO_ID=?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            flash_set('warning', 'Empleado eliminado.');
        }
    } catch (mysqli_sql_exception $e) {
        flash_set('danger', 'Error: ' . $e->getMessage());
    }
    redirect('empleados.php');
}

$edit = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $conn->prepare('SELECT * FROM EMPLEADO WHERE EMPLEADO_ID=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $edit = $stmt->get_result()->fetch_assoc() ?: null;
}

$stmt = $conn->prepare('SELECT * FROM EMPLEADO ORDER BY EMPLEADO_ID DESC');
$stmt->execute();
$rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

page_header('Empleados');
?>

<div class="card shadow-sm mb-4">
  <div class="card-body">
    <form method="post" class="row g-3">
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
        <?php if ($edit): ?><a class="btn btn-secondary" href="empleados.php">Cancelar</a><?php endif; ?>
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
                <a class="btn btn-sm btn-outline-primary" href="empleados.php?edit=<?= h($r['EMPLEADO_ID']) ?>">Editar</a>
                <form method="post" class="d-inline" onsubmit="return confirm('¿Eliminar este empleado?');">
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

<?php page_footer();
