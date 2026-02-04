<?php

declare(strict_types=1);

class ProductoController extends CrudController
{
    public function __construct()
    {
        $this->title = 'Producto';
        $this->baseRoute = '/productos';
        $this->fields = [
            'PRODUCTO_ID',
            'CATEGORIA_ID',
            'PROVEEDOR_ID',
            'TALLA_ID',
            'CODIGO',
            'DESCRIPCION',
            'COLOR',
            'MARCA',
            'STOCK',
            'PRECIO',
        ];
        $this->labels = [
            'PRODUCTO_ID' => 'ID',
            'CATEGORIA_ID' => 'Categoría',
            'PROVEEDOR_ID' => 'Proveedor',
            'TALLA_ID' => 'Talla',
            'CODIGO' => 'Código',
            'DESCRIPCION' => 'Descripción',
            'COLOR' => 'Color',
            'MARCA' => 'Marca',
            'STOCK' => 'Stock',
            'PRECIO' => 'Precio',
        ];
        $this->model = new GenericModel('_CODE_PRODUCTO', 'PRODUCTO_ID', $this->fields);
    }
}
