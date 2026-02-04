<?php

declare(strict_types=1);

class DashboardController extends BaseController
{
    public function index(): void
    {
        $cards = [
            [
                'view' => 'cards/categorias',
                'label' => 'Categorías',
                'count' => (new CategoriaModel())->count(),
                'route' => '/categorias',
            ],
            [
                'view' => 'cards/clientes',
                'label' => 'Clientes',
                'count' => (new ClienteModel())->count(),
                'route' => '/clientes',
            ],
            [
                'view' => 'cards/empleados',
                'label' => 'Empleados',
                'count' => (new EmpleadoModel())->count(),
                'route' => '/empleados',
            ],
            [
                'view' => 'cards/proveedores',
                'label' => 'Proveedores',
                'count' => (new ProveedorModel())->count(),
                'route' => '/proveedores',
            ],
            [
                'view' => 'cards/tallas',
                'label' => 'Tallas',
                'count' => (new TallaModel())->count(),
                'route' => '/tallas',
            ],
            [
                'view' => 'cards/productos',
                'label' => 'Productos',
                'count' => (new ProductoModel())->count(),
                'route' => '/productos',
            ],
            [
                'view' => 'cards/ventas',
                'label' => 'Ventas',
                'count' => (new VentaModel())->count(),
                'route' => '/ventas',
            ],
        ];

        $this->render('dashboard/index', [
            'cards' => $cards,
        ]);
    }
}
