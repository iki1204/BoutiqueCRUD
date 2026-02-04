<?php

declare(strict_types=1);

class DashboardController extends BaseController
{
    public function index(): void
    {
        $tables = [
            'Categorías' => ['_CODE_CATEGORIA', 'CATEGORIA_ID', '/categorias'],
            'Clientes' => ['_CODE_CLIENTE', 'CLIENTE_ID', '/clientes'],
            'Empleados' => ['_CODE_EMPLEADO', 'EMPLEADO_ID', '/empleados'],
            'Proveedores' => ['_CODE_PROVEEDOR', 'PROVEEDOR_ID', '/proveedores'],
            'Tallas' => ['_CODE_TALLA', 'TALLA_ID', '/tallas'],
            'Productos' => ['_CODE_PRODUCTO', 'PRODUCTO_ID', '/productos'],
            'Ventas' => ['_CODE_VENTAS', 'VENTA_ID', '/ventas'],
        ];

        $cards = [];
        foreach ($tables as $label => [$table, $pk, $route]) {
            $model = new GenericModel($table, $pk, [$pk]);
            $cards[] = [
                'label' => $label,
                'count' => $model->count(),
                'route' => $route,
            ];
        }

        $this->render('dashboard/index', [
            'cards' => $cards,
        ]);
    }
}
