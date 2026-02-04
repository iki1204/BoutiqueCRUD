<?php

declare(strict_types=1);

class CategoriaController extends CrudController
{
    public function __construct()
    {
        $this->title = 'Categoría';
        $this->baseRoute = '/?controller=categoria';
        $this->fields = ['CATEGORIA_ID', 'CODIGO', 'DESCRIPCION'];
        $this->labels = [
            'CATEGORIA_ID' => 'ID',
            'CODIGO' => 'Código',
            'DESCRIPCION' => 'Descripción',
        ];
        $this->model = new GenericModel('_CODE_CATEGORIA', 'CATEGORIA_ID', $this->fields);
    }
}
