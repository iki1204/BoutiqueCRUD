<?php

declare(strict_types=1);

class ClienteController extends CrudController
{
    public function __construct()
    {
        $this->title = 'Cliente';
        $this->baseRoute = '/clientes';
        $this->fields = ['CLIENTE_ID', 'CODIGO', 'APELLIDO', 'TELEFONO', 'EMAIL', 'DIRECCION'];
        $this->labels = [
            'CLIENTE_ID' => 'ID',
            'CODIGO' => 'Código',
            'APELLIDO' => 'Apellido',
            'TELEFONO' => 'Teléfono',
            'EMAIL' => 'Email',
            'DIRECCION' => 'Dirección',
        ];
        $this->model = new GenericModel('_CODE_CLIENTE', 'CLIENTE_ID', $this->fields);
    }
}
