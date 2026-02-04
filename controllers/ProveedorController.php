<?php

declare(strict_types=1);

class ProveedorController extends BaseController
{
    private ProveedorModel $model;

    public function __construct()
    {
        $this->model = new ProveedorModel();
    }

    public function index(): void
    {
        $this->render('proveedor/index', [
            'proveedores' => $this->model->getAll(),
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($this->getPayload());
            $this->redirect('/proveedores');
        }

        $this->render('proveedor/form', [
            'title' => 'Nuevo proveedor',
            'action' => '/proveedores/crear',
            'proveedor' => null,
        ]);
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect('/proveedores');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $this->getPayload());
            $this->redirect('/proveedores');
        }

        $proveedor = $this->model->getById($id);
        if (!$proveedor) {
            $this->redirect('/proveedores');
        }

        $this->render('proveedor/form', [
            'title' => 'Editar proveedor',
            'action' => '/proveedores/editar/' . $id,
            'proveedor' => $proveedor,
        ]);
    }

    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->model->delete($id);
        }
        $this->redirect('/proveedores');
    }

    private function getPayload(): array
    {
        return [
            'PROVEEDOR_ID' => (int) ($_POST['PROVEEDOR_ID'] ?? 0),
            'NOMBRE_EMPRESA' => trim((string) ($_POST['NOMBRE_EMPRESA'] ?? '')),
            'TELEFONO' => trim((string) ($_POST['TELEFONO'] ?? '')),
            'EMAIL' => trim((string) ($_POST['EMAIL'] ?? '')),
            'DIRECCION' => trim((string) ($_POST['DIRECCION'] ?? '')),
            'CIUDAD' => trim((string) ($_POST['CIUDAD'] ?? '')),
        ];
    }
}
