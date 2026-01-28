<?php
require_once __DIR__ . '/../Models/Venta.php';

class VentasController
{
    public function index(): void
    {
        $clientes = get_options('CLIENTE', 'CLIENTE_ID', 'NOMBRE');
        $productos = get_options('PRODUCTO', 'PRODUCTO_ID', 'NOMBRE');
        $empleados = get_options('EMPLEADO', 'EMPLEADO_ID', 'NOMBRE');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';
            try {
                if ($accion === 'crear') {
                    $id = (int)($_POST['VENTA_ID'] ?? 0);
                    $clienteId = (int)($_POST['CLIENTE_ID'] ?? 0);
                    $empleadoId = (int)($_POST['EMPLEADO_ID'] ?? 0);
                    $fecha = trim($_POST['FECHA'] ?? '');
                    $fechaDb = $fecha ? date('Y-m-d H:i:s', strtotime($fecha)) : null;
                    $total = (float)($_POST['TOTAL'] ?? 0);
                    $metodo = trim($_POST['METODO_PAGO'] ?? '');

                    Venta::create($id, $clienteId, $empleadoId, $fechaDb, $total, $metodo);
                    flash_set('success', 'Venta creada.');
                } elseif ($accion === 'actualizar') {
                    $id = (int)($_POST['VENTA_ID'] ?? 0);
                    $clienteId = (int)($_POST['CLIENTE_ID'] ?? 0);
                    $empleadoId = (int)($_POST['EMPLEADO_ID'] ?? 0);
                    $fecha = trim($_POST['FECHA'] ?? '');
                    $fechaDb = $fecha ? date('Y-m-d H:i:s', strtotime($fecha)) : null;
                    $total = (float)($_POST['TOTAL'] ?? 0);
                    $metodo = trim($_POST['METODO_PAGO'] ?? '');

                    Venta::update($id, $clienteId, $empleadoId, $fechaDb, $total, $metodo);
                    flash_set('success', 'Venta actualizada.');
                } elseif ($accion === 'eliminar') {
                    $id = (int)($_POST['VENTA_ID'] ?? 0);
                    Venta::delete($id);
                    flash_set('warning', 'Venta eliminada.');
                }
            } catch (mysqli_sql_exception $e) {
                flash_set('danger', 'Error: ' . $e->getMessage());
            }
            redirect('index.php?route=ventas');
        }

        $edit = null;
        if (isset($_GET['edit'])) {
            $edit = Venta::find((int)$_GET['edit']);
        }

        render('ventas/index', [
            'title' => 'Ventas',
            'edit' => $edit,
            'rows' => Venta::allWithDetalles(),
            'clientes' => $clientes,
            'productos' => $productos,
            'empleados' => $empleados,
        ]);
    }
}
