<?php

declare(strict_types=1);

class ClienteController extends BaseController
{
    private ClienteModel $model;

    public function __construct()
    {
        $this->model = new ClienteModel();
    }

    public function index(): void
    {
        $this->render('cliente/index', [
            'clientes' => $this->model->getAll(),
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($this->getPayload());
            $this->redirect('/?controller=cliente');
        }

        $this->render('cliente/form', [
            'title' => 'Nuevo cliente',
            'action' => '/?controller=cliente&action=create',
            'cliente' => null,
        ]);
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect('/?controller=cliente');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $this->getPayload());
            $this->redirect('/?controller=cliente');
        }

        $cliente = $this->model->getById($id);
        if (!$cliente) {
            $this->redirect('/?controller=cliente');
        }

        $this->render('cliente/form', [
            'title' => 'Editar cliente',
            'action' => '/?controller=cliente&action=edit&id=' . $id,
            'cliente' => $cliente,
        ]);
    }

    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->model->delete($id);
        }
        $this->redirect('/?controller=cliente');
    }

    private function getPayload(): array
    {
        return [
            'CLIENTE_ID' => (int) ($_POST['CLIENTE_ID'] ?? 0),
            'CODIGO' => trim((string) ($_POST['CODIGO'] ?? '')),
            'APELLIDO' => trim((string) ($_POST['APELLIDO'] ?? '')),
            'TELEFONO' => trim((string) ($_POST['TELEFONO'] ?? '')),
            'EMAIL' => trim((string) ($_POST['EMAIL'] ?? '')),
            'DIRECCION' => trim((string) ($_POST['DIRECCION'] ?? '')),
        ];
    }
}
