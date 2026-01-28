<?php
require_once __DIR__ . '/../Models/Inventario.php';

class InventarioController
{
    public function index(): void
    {
        $productos = get_options('PRODUCTO', 'PRODUCTO_ID', 'NOMBRE');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';
            try {
                if ($accion === 'crear') {
                    $id = (int)($_POST['INVENTARIO_ID'] ?? 0);
                    $productoId = (int)($_POST['PRODUCTO_ID'] ?? 0);
                    $talla = trim($_POST['TALLA'] ?? '');
                    $color = trim($_POST['COLOR'] ?? '');
                    $stock = (int)($_POST['STOCK'] ?? 0);
                    $precio = (float)($_POST['PRECIO'] ?? 0);
                    Inventario::create($id, $productoId, $talla, $color, $stock, $precio);
                    flash_set('success', 'Inventario creado.');
                } elseif ($accion === 'actualizar') {
                    $id = (int)($_POST['INVENTARIO_ID'] ?? 0);
                    $productoId = (int)($_POST['PRODUCTO_ID'] ?? 0);
                    $talla = trim($_POST['TALLA'] ?? '');
                    $color = trim($_POST['COLOR'] ?? '');
                    $stock = (int)($_POST['STOCK'] ?? 0);
                    $precio = (float)($_POST['PRECIO'] ?? 0);
                    Inventario::update($id, $productoId, $talla, $color, $stock, $precio);
                    flash_set('success', 'Inventario actualizado.');
                } elseif ($accion === 'eliminar') {
                    $id = (int)($_POST['INVENTARIO_ID'] ?? 0);
                    Inventario::delete($id);
                    flash_set('warning', 'Inventario eliminado.');
                }
            } catch (mysqli_sql_exception $e) {
                flash_set('danger', 'Error: ' . $e->getMessage());
            }
            redirect('index.php?route=inventario');
        }

        $edit = null;
        if (isset($_GET['edit'])) {
            $edit = Inventario::find((int)$_GET['edit']);
        }

        render('inventario/index', [
            'title' => 'Inventario',
            'edit' => $edit,
            'rows' => Inventario::allWithProducto(),
            'productos' => $productos,
        ]);
    }
}
