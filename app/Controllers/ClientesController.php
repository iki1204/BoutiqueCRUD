<?php
require_once __DIR__ . '/../Models/Cliente.php';

class ClientesController
{
    public function index(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';
            try {
                if ($accion === 'crear') {
                    $id = (int)($_POST['CLIENTE_ID'] ?? 0);
                    $nombre = trim($_POST['NOMBRE'] ?? '');
                    $apellido = trim($_POST['APELLIDO'] ?? '');
                    $telefono = trim($_POST['TELEFONO'] ?? '');
                    $email = trim($_POST['EMAIL'] ?? '');
                    $direccion = trim($_POST['DIRECCION'] ?? '');
                    Cliente::create($id, $nombre, $apellido, $telefono, $email, $direccion);
                    flash_set('success', 'Cliente creado.');
                } elseif ($accion === 'actualizar') {
                    $id = (int)($_POST['CLIENTE_ID'] ?? 0);
                    $nombre = trim($_POST['NOMBRE'] ?? '');
                    $apellido = trim($_POST['APELLIDO'] ?? '');
                    $telefono = trim($_POST['TELEFONO'] ?? '');
                    $email = trim($_POST['EMAIL'] ?? '');
                    $direccion = trim($_POST['DIRECCION'] ?? '');
                    Cliente::update($id, $nombre, $apellido, $telefono, $email, $direccion);
                    flash_set('success', 'Cliente actualizado.');
                } elseif ($accion === 'eliminar') {
                    $id = (int)($_POST['CLIENTE_ID'] ?? 0);
                    Cliente::delete($id);
                    flash_set('warning', 'Cliente eliminado.');
                }
            } catch (mysqli_sql_exception $e) {
                flash_set('danger', 'Error: ' . $e->getMessage());
            }
            redirect('index.php?route=clientes');
        }

        $edit = null;
        if (isset($_GET['edit'])) {
            $edit = Cliente::find((int)$_GET['edit']);
        }

        render('clientes/index', [
            'title' => 'Clientes',
            'edit' => $edit,
            'rows' => Cliente::all(),
        ]);
    }
}
