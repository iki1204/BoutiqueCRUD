<?php

declare(strict_types=1);

class TallaController extends BaseController
{
    private TallaModel $model;

    public function __construct()
    {
        $this->model = new TallaModel();
    }

    public function index(): void
    {
        $this->render('talla/index', [
            'tallas' => $this->model->getAll(),
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($this->getPayload());
            $this->redirect('/tallas');
        }

        $this->render('talla/form', [
            'title' => 'Nueva talla',
            'action' => '/tallas/crear',
            'talla' => null,
        ]);
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect('/tallas');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $this->getPayload());
            $this->redirect('/tallas');
        }

        $talla = $this->model->getById($id);
        if (!$talla) {
            $this->redirect('/tallas');
        }

        $this->render('talla/form', [
            'title' => 'Editar talla',
            'action' => '/tallas/editar/' . $id,
            'talla' => $talla,
        ]);
    }

    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->model->delete($id);
        }
        $this->redirect('/tallas');
    }

    private function getPayload(): array
    {
        return [
            'TALLA_ID' => (int) ($_POST['TALLA_ID'] ?? 0),
            'CODIGO' => trim((string) ($_POST['CODIGO'] ?? '')),
            'DESCRIPCION' => trim((string) ($_POST['DESCRIPCION'] ?? '')),
        ];
    }
}
