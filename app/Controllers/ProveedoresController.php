<?php
require_once __DIR__ . '/../Models/Proveedor.php';

class ProveedoresController
{
    public function index(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';
            try {
                if ($accion === 'crear') {
                    $id = (int)($_POST['PROVEEDOR_ID'] ?? 0);
                    $empresa = trim($_POST['NOMBRE_EMPRESA'] ?? '');
                    $telefono = trim($_POST['TELEFONO'] ?? '');
                    $email = trim($_POST['EMAIL'] ?? '');
                    $direccion = trim($_POST['DIRECCION'] ?? '');
                    $ciudad = trim($_POST['CIUDAD'] ?? '');
                    Proveedor::create($id, $empresa, $telefono, $email, $direccion, $ciudad);
                    flash_set('success', 'Proveedor creado.');
                } elseif ($accion === 'actualizar') {
                    $id = (int)($_POST['PROVEEDOR_ID'] ?? 0);
                    $empresa = trim($_POST['NOMBRE_EMPRESA'] ?? '');
                    $telefono = trim($_POST['TELEFONO'] ?? '');
                    $email = trim($_POST['EMAIL'] ?? '');
                    $direccion = trim($_POST['DIRECCION'] ?? '');
                    $ciudad = trim($_POST['CIUDAD'] ?? '');
                    Proveedor::update($id, $empresa, $telefono, $email, $direccion, $ciudad);
                    flash_set('success', 'Proveedor actualizado.');
                } elseif ($accion === 'eliminar') {
                    $id = (int)($_POST['PROVEEDOR_ID'] ?? 0);
                    Proveedor::delete($id);
                    flash_set('warning', 'Proveedor eliminado.');
                }
            } catch (mysqli_sql_exception $e) {
                flash_set('danger', 'Error: ' . $e->getMessage());
            }
            redirect('index.php?route=proveedores');
        }

        $edit = null;
        if (isset($_GET['edit'])) {
            $edit = Proveedor::find((int)$_GET['edit']);
        }

        render('proveedores/index', [
            'title' => 'Proveedores',
            'edit' => $edit,
            'rows' => Proveedor::all(),
        ]);
    }
}
