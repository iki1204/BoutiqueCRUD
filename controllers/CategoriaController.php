<?php

declare(strict_types=1);

class CategoriaController extends BaseController
{
    private CategoriaModel $model;

    public function __construct()
    {
        $this->model = new CategoriaModel();
    }

    public function index(): void
    {
        $this->render('categoria/index', [
            'categorias' => $this->model->getAll(),
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($this->getPayload());
            $this->redirect('/?controller=categoria');
        }

        $this->render('categoria/form', [
            'title' => 'Nueva categoría',
            'action' => '/?controller=categoria&action=create',
            'categoria' => null,
        ]);
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect('/?controller=categoria');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $this->getPayload());
            $this->redirect('/?controller=categoria');
        }

        $categoria = $this->model->getById($id);
        if (!$categoria) {
            $this->redirect('/?controller=categoria');
        }

        $this->render('categoria/form', [
            'title' => 'Editar categoría',
            'action' => '/?controller=categoria&action=edit&id=' . $id,
            'categoria' => $categoria,
        ]);
    }

    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->model->delete($id);
        }
        $this->redirect('/?controller=categoria');
    }

    private function getPayload(): array
    {
        return [
            'CATEGORIA_ID' => (int) ($_POST['CATEGORIA_ID'] ?? 0),
            'CODIGO' => trim((string) ($_POST['CODIGO'] ?? '')),
            'DESCRIPCION' => trim((string) ($_POST['DESCRIPCION'] ?? '')),
        ];
    }
}
