<?php

declare(strict_types=1);

class CrudController extends BaseController
{
    protected GenericModel $model;
    protected string $title;
    protected string $baseRoute;
    protected array $fields;
    protected array $labels;

    public function index(): void
    {
        $items = $this->model->getAll();
        $this->render('shared/list', [
            'title' => $this->title,
            'items' => $items,
            'fields' => $this->fields,
            'labels' => $this->labels,
            'baseRoute' => $this->baseRoute,
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPayload();
            $this->model->create($data);
            $this->redirect($this->baseRoute);
        }

        $this->render('shared/form', [
            'title' => "Crear {$this->title}",
            'fields' => $this->fields,
            'labels' => $this->labels,
            'action' => $this->baseRoute . '/crear',
            'cancelRoute' => $this->baseRoute,
            'values' => [],
        ]);
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect($this->baseRoute);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPayload();
            $this->model->update($id, $data);
            $this->redirect($this->baseRoute);
        }

        $item = $this->model->getById($id);
        if (!$item) {
            $this->redirect($this->baseRoute);
        }

        $this->render('shared/form', [
            'title' => "Editar {$this->title}",
            'fields' => $this->fields,
            'labels' => $this->labels,
            'action' => $this->baseRoute . '/editar/' . $id,
            'cancelRoute' => $this->baseRoute,
            'values' => $item,
        ]);
    }

    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->model->delete($id);
        }
        $this->redirect($this->baseRoute);
    }

    protected function getPayload(): array
    {
        $data = [];
        foreach ($this->fields as $field) {
            $data[$field] = trim((string) ($_POST[$field] ?? ''));
        }

        return $data;
    }
}
