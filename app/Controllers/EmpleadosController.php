<?php
require_once __DIR__ . '/../Models/Empleado.php';

class EmpleadosController
{
    public function index(): void
    {
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
                    $fechaDb = $fecha ? date('Y-m-d H:i:s', strtotime($fecha)) : null;

                    Empleado::create($id, $nombre, $apellido, $cargo, $telefono, $direccion, $fechaDb);
                    flash_set('success', 'Empleado creado.');
                } elseif ($accion === 'actualizar') {
                    $id = (int)($_POST['EMPLEADO_ID'] ?? 0);
                    $nombre = trim($_POST['NOMBRE'] ?? '');
                    $apellido = trim($_POST['APELLIDO'] ?? '');
                    $cargo = trim($_POST['CARGO'] ?? '');
                    $telefono = trim($_POST['TELEFONO'] ?? '');
                    $direccion = trim($_POST['DIRECCION'] ?? '');
                    $fecha = trim($_POST['FECHA_INGRESO'] ?? '');
                    $fechaDb = $fecha ? date('Y-m-d H:i:s', strtotime($fecha)) : null;

                    Empleado::update($id, $nombre, $apellido, $cargo, $telefono, $direccion, $fechaDb);
                    flash_set('success', 'Empleado actualizado.');
                } elseif ($accion === 'eliminar') {
                    $id = (int)($_POST['EMPLEADO_ID'] ?? 0);
                    Empleado::delete($id);
                    flash_set('warning', 'Empleado eliminado.');
                }
            } catch (mysqli_sql_exception $e) {
                flash_set('danger', 'Error: ' . $e->getMessage());
            }
            redirect('index.php?route=empleados');
        }

        $edit = null;
        if (isset($_GET['edit'])) {
            $edit = Empleado::find((int)$_GET['edit']);
        }

        render('empleados/index', [
            'title' => 'Empleados',
            'edit' => $edit,
            'rows' => Empleado::all(),
        ]);
    }
}
