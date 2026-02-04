<?php

declare(strict_types=1);

class TallaController extends CrudController
{
    public function __construct()
    {
        $this->title = 'Talla';
        $this->baseRoute = '/?controller=talla';
        $this->fields = ['TALLA_ID', 'CODIGO', 'DESCRIPCION'];
        $this->labels = [
            'TALLA_ID' => 'ID',
            'CODIGO' => 'Código',
            'DESCRIPCION' => 'Descripción',
        ];
        $this->model = new GenericModel('_CODE_TALLA', 'TALLA_ID', $this->fields);
    }
}
