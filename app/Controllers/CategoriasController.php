<?php
require_once __DIR__ . '/../Models/Categoria.php';

class CategoriasController
{
    public function index(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST['accion'] ?? '';
            try {
                if ($accion === 'crear') {
                    $id = (int)($_POST['CATEGORIA_ID'] ?? 0);
                    $nombre = trim($_POST['NOMBRE'] ?? '');
                    $desc = trim($_POST['DESCRIPCION'] ?? '');
                    Categoria::create($id, $nombre, $desc);
                    flash_set('success', 'Categoría creada.');
                } elseif ($accion === 'actualizar') {
                    $id = (int)($_POST['CATEGORIA_ID'] ?? 0);
                    $nombre = trim($_POST['NOMBRE'] ?? '');
                    $desc = trim($_POST['DESCRIPCION'] ?? '');
                    Categoria::update($id, $nombre, $desc);
                    flash_set('success', 'Categoría actualizada.');
                } elseif ($accion === 'eliminar') {
                    $id = (int)($_POST['CATEGORIA_ID'] ?? 0);
                    Categoria::delete($id);
                    flash_set('warning', 'Categoría eliminada.');
                }
            } catch (mysqli_sql_exception $e) {
                flash_set('danger', 'Error: ' . $e->getMessage());
            }
            redirect('index.php?route=categorias');
        }

        $edit = null;
        if (isset($_GET['edit'])) {
            $edit = Categoria::find((int)$_GET['edit']);
        }

        render('categorias/index', [
            'title' => 'Categorías',
            'edit' => $edit,
            'rows' => Categoria::all(),
        ]);
    }
}
