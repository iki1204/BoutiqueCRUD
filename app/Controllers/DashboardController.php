<?php
class DashboardController
{
    public function index(): void
    {
        $cards = [
            ['Categorías', 'categorias', 'Administra categorías de productos'],
            ['Clientes', 'clientes', 'Clientes registrados'],
            ['Empleados', 'empleados', 'Personal y cargos'],
            ['Proveedores', 'proveedores', 'Empresas proveedoras'],
            ['Productos', 'productos', 'Catálogo base'],
            ['Inventario', 'inventario', 'Tallas, colores, stock y precio'],
            ['Ventas', 'ventas', 'Cabecera de ventas'],
        ];

        render('dashboard/index', [
            'title' => 'Sistema de Gestión de Boutique',
            'cards' => $cards,
        ]);
    }
}
