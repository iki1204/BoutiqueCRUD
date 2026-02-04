<?php

declare(strict_types=1);

class DashboardController extends BaseController
{
    public function index(): void
    {
        $tables = [
            'Categorías' => ['_CODE_CATEGORIA', 'CATEGORIA_ID', '/?controller=categoria'],
            'Clientes' => ['_CODE_CLIENTE', 'CLIENTE_ID', '/?controller=cliente'],
            'Empleados' => ['_CODE_EMPLEADO', 'EMPLEADO_ID', '/?controller=empleado'],
            'Proveedores' => ['_CODE_PROVEEDOR', 'PROVEEDOR_ID', '/?controller=proveedor'],
            'Tallas' => ['_CODE_TALLA', 'TALLA_ID', '/?controller=talla'],
            'Productos' => ['_CODE_PRODUCTO', 'PRODUCTO_ID', '/?controller=producto'],
            'Ventas' => ['_CODE_VENTAS', 'VENTA_ID', '/?controller=ventas'],
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
