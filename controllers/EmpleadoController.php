<?php

declare(strict_types=1);

class EmpleadoController extends BaseController
{
    private EmpleadoModel $model;

    public function __construct()
    {
        $this->model = new EmpleadoModel();
    }

    public function index(): void
    {
        $this->render('empleado/index', [
            'empleados' => $this->model->getAll(),
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($this->getPayload());
            $this->redirect('/empleados');
        }

        $this->render('empleado/form', [
            'title' => 'Nuevo empleado',
            'action' => '/empleados/crear',
            'empleado' => null,
        ]);
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect('/empleados');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $this->getPayload());
            $this->redirect('/empleados');
        }

        $empleado = $this->model->getById($id);
        if (!$empleado) {
            $this->redirect('/empleados');
        }

        $this->render('empleado/form', [
            'title' => 'Editar empleado',
            'action' => '/empleados/editar/' . $id,
            'empleado' => $empleado,
        ]);
    }

    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->model->delete($id);
        }
        $this->redirect('/empleados');
    }

    private function getPayload(): array
    {
        return [
            'EMPLEADO_ID' => (int) ($_POST['EMPLEADO_ID'] ?? 0),
            'CODIGO' => trim((string) ($_POST['CODIGO'] ?? '')),
            'APELLIDO' => trim((string) ($_POST['APELLIDO'] ?? '')),
            'CARGO' => trim((string) ($_POST['CARGO'] ?? '')),
            'TELEFONO' => trim((string) ($_POST['TELEFONO'] ?? '')),
            'DIRECCION' => trim((string) ($_POST['DIRECCION'] ?? '')),
            'FECHA_INGRESO' => trim((string) ($_POST['FECHA_INGRESO'] ?? '')),
        ];
    }
}
