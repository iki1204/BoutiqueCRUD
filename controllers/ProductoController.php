<?php

declare(strict_types=1);

class ProductoController extends BaseController
{
    private ProductoModel $model;
    private CategoriaModel $categoriaModel;
    private ProveedorModel $proveedorModel;
    private TallaModel $tallaModel;

    public function __construct()
    {
        $this->model = new ProductoModel();
        $this->categoriaModel = new CategoriaModel();
        $this->proveedorModel = new ProveedorModel();
        $this->tallaModel = new TallaModel();
    }

    public function index(): void
    {
        $this->render('producto/index', [
            'productos' => $this->model->getAll(),
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($this->getPayload());
            $this->redirect('/?controller=producto');
        }

        $this->render('producto/form', [
            'title' => 'Nuevo producto',
            'action' => '/?controller=producto&action=create',
            'producto' => null,
            'categorias' => $this->categoriaModel->getAll(),
            'proveedores' => $this->proveedorModel->getAll(),
            'tallas' => $this->tallaModel->getAll(),
        ]);
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect('/?controller=producto');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $this->getPayload());
            $this->redirect('/?controller=producto');
        }

        $producto = $this->model->getById($id);
        if (!$producto) {
            $this->redirect('/?controller=producto');
        }

        $this->render('producto/form', [
            'title' => 'Editar producto',
            'action' => '/?controller=producto&action=edit&id=' . $id,
            'producto' => $producto,
            'categorias' => $this->categoriaModel->getAll(),
            'proveedores' => $this->proveedorModel->getAll(),
            'tallas' => $this->tallaModel->getAll(),
        ]);
    }

    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->model->delete($id);
        }
        $this->redirect('/?controller=producto');
    }

    private function getPayload(): array
    {
        return [
            'PRODUCTO_ID' => (int) ($_POST['PRODUCTO_ID'] ?? 0),
            'CATEGORIA_ID' => (int) ($_POST['CATEGORIA_ID'] ?? 0),
            'PROVEEDOR_ID' => (int) ($_POST['PROVEEDOR_ID'] ?? 0),
            'TALLA_ID' => (int) ($_POST['TALLA_ID'] ?? 0),
            'CODIGO' => trim((string) ($_POST['CODIGO'] ?? '')),
            'DESCRIPCION' => trim((string) ($_POST['DESCRIPCION'] ?? '')),
            'COLOR' => trim((string) ($_POST['COLOR'] ?? '')),
            'MARCA' => trim((string) ($_POST['MARCA'] ?? '')),
            'STOCK' => (int) ($_POST['STOCK'] ?? 0),
            'PRECIO' => (float) ($_POST['PRECIO'] ?? 0),
        ];
    }
}
