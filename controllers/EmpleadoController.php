<?php

declare(strict_types=1);

class EmpleadoController extends CrudController
{
    public function __construct()
    {
        $this->title = 'Empleado';
        $this->baseRoute = '/empleados';
        $this->fields = [
            'EMPLEADO_ID',
            'CODIGO',
            'APELLIDO',
            'CARGO',
            'TELEFONO',
            'DIRECCION',
            'FECHA_INGRESO',
        ];
        $this->labels = [
            'EMPLEADO_ID' => 'ID',
            'CODIGO' => 'Código',
            'APELLIDO' => 'Apellido',
            'CARGO' => 'Cargo',
            'TELEFONO' => 'Teléfono',
            'DIRECCION' => 'Dirección',
            'FECHA_INGRESO' => 'Fecha de ingreso',
        ];
        $this->model = new GenericModel('_CODE_EMPLEADO', 'EMPLEADO_ID', $this->fields);
    }
}
