<?php

declare(strict_types=1);

class ProveedorController extends CrudController
{
    public function __construct()
    {
        $this->title = 'Proveedor';
        $this->baseRoute = '/?controller=proveedor';
        $this->fields = [
            'PROVEEDOR_ID',
            'NOMBRE_EMPRESA',
            'TELEFONO',
            'EMAIL',
            'DIRECCION',
            'CIUDAD',
        ];
        $this->labels = [
            'PROVEEDOR_ID' => 'ID',
            'NOMBRE_EMPRESA' => 'Empresa',
            'TELEFONO' => 'Teléfono',
            'EMAIL' => 'Email',
            'DIRECCION' => 'Dirección',
            'CIUDAD' => 'Ciudad',
        ];
        $this->model = new GenericModel('_CODE_PROVEEDOR', 'PROVEEDOR_ID', $this->fields);
    }
}
