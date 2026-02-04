<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../helpers.php';

$title = "Ventas";
$action = $_GET['a'] ?? 'list';
$id = $_GET['id'] ?? null;

csrf_check();

function clients(PDO $pdo): array {
  return $pdo->query("SELECT CLIENTE_ID AS id, CONCAT(CODIGO,' - ',APELLIDO) AS label FROM _CODE_CLIENTE ORDER BY APELLIDO")->fetchAll();
}
function employees(PDO $pdo): array {
  return $pdo->query("SELECT EMPLEADO_ID AS id, CONCAT(CODIGO,' - ',APELLIDO) AS label FROM _CODE_EMPLEADO ORDER BY APELLIDO")->fetchAll();
}
function products(PDO $pdo): array {
  return $pdo->query("SELECT PRODUCTO_ID AS id, CONCAT(CODIGO,' - ',DESCRIPCION,' (Stock: ',STOCK,')') AS label, PRECIO AS precio, STOCK AS stock FROM _CODE_PRODUCTO ORDER BY DESCRIPCION")->fetchAll();
}

if ($action === 'delete' && $id) {
  // Restock before delete (simple approach)
  $pdo->beginTransaction();
  try {
    $d = $pdo->prepare("SELECT PRODUCTO_ID, CANTIDAD FROM _CODE_DETALLE_VENTA WHERE VENTA_ID=?");
    $d->execute([$id]);
    foreach ($d->fetchAll() as $row) {
      $u = $pdo->prepare("UPDATE _CODE_PRODUCTO SET STOCK = STOCK + ? WHERE PRODUCTO_ID=?");
      $u->execute([$row['CANTIDAD'], $row['PRODUCTO_ID']]);
    }
    $pdo->prepare("DELETE FROM _CODE_DETALLE_VENTA WHERE VENTA_ID=?")->execute([$id]);
    $pdo->prepare("DELETE FROM _CODE_VENTAS WHERE VENTA_ID=?")->execute([$id]);
    $pdo->commit();
    flash_set('success','Venta eliminada (y stock restaurado).');
  } catch (Throwable $e) {
    $pdo->rollBack();
    flash_set('danger','No se pudo eliminar: '.$e->getMessage());
  }
  redirect(url("/public/index.php?m=ventas"));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($action === 'create') {
    $cliente_id = (int)($_POST['CLIENTE_ID'] ?? 0);
    $empleado_id = (int)($_POST['EMPLEADO_ID'] ?? 0);
    $fecha = $_POST['FECHA'] ?? date('Y-m-d\TH:i');
    $estado = trim($_POST['ESTADO'] ?? 'COMPLETADA');
    $metodo = trim($_POST['METODO_PAGO'] ?? 'EFECTIVO');

    $items = $_POST['items'] ?? [];
    $items = array_values(array_filter($items, fn($it)=>!empty($it['PRODUCTO_ID']) && (int)$it['CANTIDAD']>0));
    if (!$cliente_id || !$empleado_id || count($items)===0) {
      flash_set('danger','Completa cliente, empleado y al menos 1 producto.');
      redirect(url("/public/index.php?m=ventas&a=create"));
    }

    $pdo->beginTransaction();
    try {
      // next venta id (because schema doesn't autoincrement)
      $venta_id = (int)($pdo->query("SELECT IFNULL(MAX(VENTA_ID),0)+1 AS n FROM _CODE_VENTAS")->fetch()['n']);
      $detalle_id = (int)($pdo->query("SELECT IFNULL(MAX(DETALLE_ID),0)+1 AS n FROM _CODE_DETALLE_VENTA")->fetch()['n']);

      $total = 0.0;

      // Insert venta first with total 0; update later
      $fecha_db = date('Y-m-d H:i:s', strtotime($fecha));
      $stmt = $pdo->prepare("INSERT INTO _CODE_VENTAS (VENTA_ID, CLIENTE_ID, EMPLEADO_ID, FECHA, TOTAL, ESTADO, METODO_PAGO) VALUES (?,?,?,?,?,?,?)");
      $stmt->execute([$venta_id, $cliente_id, $empleado_id, $fecha_db, 0, $estado, $metodo]);

      foreach ($items as $it) {
        $producto_id = (int)$it['PRODUCTO_ID'];
        $cantidad = (int)$it['CANTIDAD'];
        $precio = (float)$it['PRECIO'];

        // validate stock
        $p = $pdo->prepare("SELECT STOCK, PRECIO FROM _CODE_PRODUCTO WHERE PRODUCTO_ID=? FOR UPDATE");
        $p->execute([$producto_id]);
        $prod = $p->fetch();
        if (!$prod) throw new Exception("Producto inválido: $producto_id");
        if ($precio <= 0) $precio = (float)$prod['PRECIO'];
        if ((int)$prod['STOCK'] < $cantidad) throw new Exception("Stock insuficiente para producto $producto_id");

        $pdo->prepare("INSERT INTO _CODE_DETALLE_VENTA (DETALLE_ID, VENTA_ID, PRODUCTO_ID, CANTIDAD, PRECIO) VALUES (?,?,?,?,?)")
            ->execute([$detalle_id, $venta_id, $producto_id, $cantidad, $precio]);
        $detalle_id++;

        $pdo->prepare("UPDATE _CODE_PRODUCTO SET STOCK = STOCK - ? WHERE PRODUCTO_ID=?")->execute([$cantidad, $producto_id]);
        $total += $cantidad * $precio;
      }

      $pdo->prepare("UPDATE _CODE_VENTAS SET TOTAL=? WHERE VENTA_ID=?")->execute([$total, $venta_id]);

      $pdo->commit();
      flash_set('success','Venta creada. Total: $'.number_format($total,2));
      redirect(url("/public/index.php?m=ventas&a=view&id=$venta_id"));
    } catch (Throwable $e) {
      $pdo->rollBack();
      flash_set('danger','Error: '.$e->getMessage());
      redirect(url("/public/index.php?m=ventas&a=create"));
    }
  }

  if ($action === 'edit' && $id) {
    $estado = trim($_POST['ESTADO'] ?? '');
    $metodo = trim($_POST['METODO_PAGO'] ?? '');
    $pdo->prepare("UPDATE _CODE_VENTAS SET ESTADO=?, METODO_PAGO=? WHERE VENTA_ID=?")->execute([$estado, $metodo, $id]);
    flash_set('success','Venta actualizada.');
    redirect(url("/public/index.php?m=ventas&a=view&id=$id"));
  }
}

// Views data
$list = [];
$venta = null;
$detalle = [];
$stats = null;

if ($action === 'list') {
  $sql = "SELECT v.*, 
            CONCAT(c.CODIGO,' - ',c.APELLIDO) AS CLIENTE,
            CONCAT(e.CODIGO,' - ',e.APELLIDO) AS EMPLEADO
          FROM _CODE_VENTAS v
          JOIN _CODE_CLIENTE c ON c.CLIENTE_ID=v.CLIENTE_ID
          JOIN _CODE_EMPLEADO e ON e.EMPLEADO_ID=v.EMPLEADO_ID
          ORDER BY v.VENTA_ID DESC";
  $list = $pdo->query($sql)->fetchAll();
}

if ($action === 'create') {
  $clients = clients($pdo);
  $employees = employees($pdo);
  $products = products($pdo);
}

if ($action === 'view' && $id) {
  $stmt = $pdo->prepare("SELECT v.*, 
            CONCAT(c.CODIGO,' - ',c.APELLIDO) AS CLIENTE,
            CONCAT(e.CODIGO,' - ',e.APELLIDO) AS EMPLEADO
          FROM _CODE_VENTAS v
          JOIN _CODE_CLIENTE c ON c.CLIENTE_ID=v.CLIENTE_ID
          JOIN _CODE_EMPLEADO e ON e.EMPLEADO_ID=v.EMPLEADO_ID
          WHERE v.VENTA_ID=?");
  $stmt->execute([$id]);
  $venta = $stmt->fetch();
  if (!$venta) { http_response_code(404); echo "Venta no encontrada."; exit; }

  $d = $pdo->prepare("SELECT d.*, p.CODIGO, p.DESCRIPCION
                      FROM _CODE_DETALLE_VENTA d
                      JOIN _CODE_PRODUCTO p ON p.PRODUCTO_ID=d.PRODUCTO_ID
                      WHERE d.VENTA_ID=?
                      ORDER BY d.DETALLE_ID");
  $d->execute([$id]);
  $detalle = $d->fetchAll();
}

if ($action === 'edit' && $id) {
  $stmt = $pdo->prepare("SELECT * FROM _CODE_VENTAS WHERE VENTA_ID=?");
  $stmt->execute([$id]);
  $venta = $stmt->fetch();
  if (!$venta) { http_response_code(404); echo "Venta no encontrada."; exit; }
}

include __DIR__ . '/../views/ventas.php';
