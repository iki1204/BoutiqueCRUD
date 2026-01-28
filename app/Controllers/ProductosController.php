<?php
require_once __DIR__ . '/../Models/Producto.php';

class ProductosController
{
    public function index(): void
    {
        $categorias = get_options('CATEGORIA', 'CATEGORIA_ID', 'NOMBRE');
        $proveedores = get_options('PROVEEDOR', 'PROVEEDOR_ID', 'NOMBRE_EMPRESA');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';
            try {
                if ($accion === 'crear') {
                    $id = (int)($_POST['PRODUCTO_ID'] ?? 0);
                    $categoriaId = (int)($_POST['CATEGORIA_ID'] ?? 0);
                    $proveedorId = (int)($_POST['PROVEEDOR_ID'] ?? 0);
                    $nombre = trim($_POST['NOMBRE'] ?? '');
                    $desc = trim($_POST['DESCRIPCION'] ?? '');
                    $color = trim($_POST['COLOR'] ?? '');
                    $marca = trim($_POST['MARCA'] ?? '');
                    Producto::create($id, $categoriaId, $proveedorId, $nombre, $desc, $color, $marca);
                    flash_set('success', 'Producto creado.');
                } elseif ($accion === 'actualizar') {
                    $id = (int)($_POST['PRODUCTO_ID'] ?? 0);
                    $categoriaId = (int)($_POST['CATEGORIA_ID'] ?? 0);
                    $proveedorId = (int)($_POST['PROVEEDOR_ID'] ?? 0);
                    $nombre = trim($_POST['NOMBRE'] ?? '');
                    $desc = trim($_POST['DESCRIPCION'] ?? '');
                    $color = trim($_POST['COLOR'] ?? '');
                    $marca = trim($_POST['MARCA'] ?? '');
                    Producto::update($id, $categoriaId, $proveedorId, $nombre, $desc, $color, $marca);
                    flash_set('success', 'Producto actualizado.');
                } elseif ($accion === 'eliminar') {
                    $id = (int)($_POST['PRODUCTO_ID'] ?? 0);
                    Producto::delete($id);
                    flash_set('warning', 'Producto eliminado.');
                }
            } catch (mysqli_sql_exception $e) {
                flash_set('danger', 'Error: ' . $e->getMessage());
            }
            redirect('index.php?route=productos');
        }

        $edit = null;
        if (isset($_GET['edit'])) {
            $edit = Producto::find((int)$_GET['edit']);
        }

        render('productos/index', [
            'title' => 'Productos',
            'edit' => $edit,
            'rows' => Producto::allWithRelations(),
            'categorias' => $categorias,
            'proveedores' => $proveedores,
        ]);
    }
}
