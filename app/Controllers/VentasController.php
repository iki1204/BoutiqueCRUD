<?php
require_once __DIR__ . '/../Models/Venta.php';
require_once __DIR__ . '/../Models/DetalleVenta.php';
require_once __DIR__ . '/../Models/Inventario.php';

class VentasController
{
    public function index(): void
    {
        $clientes = get_options('CLIENTE', 'CLIENTE_ID', 'NOMBRE');
        $inventario = get_options('INVENTARIO', 'INVENTARIO_ID', 'INVENTARIO_ID');
        $empleados = get_options('EMPLEADO', 'EMPLEADO_ID', 'NOMBRE');
        $inventarioOptions = Inventario::optionsWithProducto();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';
            try {
                global $conn;
                $conn->begin_transaction();
                if ($accion === 'crear') {
                    $id = (int)($_POST['VENTA_ID'] ?? 0);
                    $clienteId = (int)($_POST['CLIENTE_ID'] ?? 0);
                    $empleadoId = (int)($_POST['EMPLEADO_ID'] ?? 0);
                    $fecha = trim($_POST['FECHA'] ?? '');
                    $fechaDb = $fecha ? date('Y-m-d H:i:s', strtotime($fecha)) : null;
                    $metodo = trim($_POST['METODO_PAGO'] ?? '');
                     $inventarioId = (int)($_POST['INVENTARIO_ID'] ?? 0);
                    $cantidad = max(1, (int)($_POST['CANTIDAD'] ?? 1));
                    $inventario = $inventarioId ? Inventario::find($inventarioId) : null;
                    $precioUnitario = $inventario ? (float)$inventario['PRECIO'] : 0.0;
                    $total = (float)($_POST['TOTAL'] ?? 0);
                    if ($total <= 0 && $precioUnitario > 0) {
                        $total = $precioUnitario * $cantidad;
                    }

                    Venta::create($id, $clienteId, $empleadoId, $fechaDb, $total, $metodo);
                    DetalleVenta::create($id, $inventarioId, $cantidad, $precioUnitario);
                    flash_set('success', 'Venta creada.');
                } elseif ($accion === 'actualizar') {
                    $id = (int)($_POST['VENTA_ID'] ?? 0);
                    $clienteId = (int)($_POST['CLIENTE_ID'] ?? 0);
                    $empleadoId = (int)($_POST['EMPLEADO_ID'] ?? 0);
                    $fecha = trim($_POST['FECHA'] ?? '');
                    $fechaDb = $fecha ? date('Y-m-d H:i:s', strtotime($fecha)) : null;
                    $total = (float)($_POST['TOTAL'] ?? 0);
                    $metodo = trim($_POST['METODO_PAGO'] ?? '');
                    $inventarioId = (int)($_POST['INVENTARIO_ID'] ?? 0);
                    $cantidad = max(1, (int)($_POST['CANTIDAD'] ?? 1));
                    $inventario = $inventarioId ? Inventario::find($inventarioId) : null;
                    $precioUnitario = $inventario ? (float)$inventario['PRECIO'] : 0.0;
                    $total = (float)($_POST['TOTAL'] ?? 0);
                    if ($total <= 0 && $precioUnitario > 0) {
                        $total = $precioUnitario * $cantidad;
                    }

                    Venta::update($id, $clienteId, $empleadoId, $fechaDb, $total, $metodo);
                    $detalleExistente = DetalleVenta::findByVenta($id);
                    if ($detalleExistente) {
                        DetalleVenta::updateByVenta($id, $inventarioId, $cantidad, $precioUnitario);
                    } else {
                        DetalleVenta::create($id, $inventarioId, $cantidad, $precioUnitario);
                    }
                    flash_set('success', 'Venta actualizada.');
                } elseif ($accion === 'eliminar') {
                    $id = (int)($_POST['VENTA_ID'] ?? 0);
                    DetalleVenta::deleteByVenta($id);
                    Venta::delete($id);
                    flash_set('warning', 'Venta eliminada.');
                }
                $conn->commit();
            } catch (mysqli_sql_exception $e) {
                if (isset($conn)) {
                    $conn->rollback();
                }
                flash_set('danger', 'Error: ' . $e->getMessage());
            }
            redirect('index.php?route=ventas');
        }

        $edit = null;
        if (isset($_GET['edit'])) {
            $ventaId = (int)$_GET['edit'];
            $edit = Venta::find($ventaId);
            $detalle = DetalleVenta::findByVenta($ventaId);
            if ($edit && $detalle) {
                $edit = array_merge($edit, $detalle);
            }
        }

        render('ventas/index', [
            'title' => 'Ventas',
            'edit' => $edit,
            'rows' => Venta::allWithDetalles(),
            'clientes' => $clientes,
            'empleados' => $empleados,
            'inventarioOptions' => $inventarioOptions,
        ]);
    }
}
