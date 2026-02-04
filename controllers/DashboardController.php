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
                'route' => '/?controller=categoria',
            ],
            [
                'view' => 'cards/clientes',
                'label' => 'Clientes',
                'count' => (new ClienteModel())->count(),
                'route' => '/?controller=cliente',
            ],
            [
                'view' => 'cards/empleados',
                'label' => 'Empleados',
                'count' => (new EmpleadoModel())->count(),
                'route' => '/?controller=empleado',
            ],
            [
                'view' => 'cards/proveedores',
                'label' => 'Proveedores',
                'count' => (new ProveedorModel())->count(),
                'route' => '/?controller=proveedor',
            ],
            [
                'view' => 'cards/tallas',
                'label' => 'Tallas',
                'count' => (new TallaModel())->count(),
                'route' => '/?controller=talla',
            ],
            [
                'view' => 'cards/productos',
                'label' => 'Productos',
                'count' => (new ProductoModel())->count(),
                'route' => '/?controller=producto',
            ],
            [
                'view' => 'cards/ventas',
                'label' => 'Ventas',
                'count' => (new VentaModel())->count(),
                'route' => '/?controller=ventas',
            ],
        ];

        $this->render('dashboard/index', [
            'cards' => $cards,
        ]);
    }
}
