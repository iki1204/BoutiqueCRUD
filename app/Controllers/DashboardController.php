<?php
class DashboardController
{
    public function index(): void
    {
        $cards = [
            ['Categorías', 'categorias', 'Administra categorías de productos', 'bi-tags'],
            ['Clientes', 'clientes', 'Clientes registrados', 'bi-people'],
            ['Empleados', 'empleados', 'Personal y cargos', 'bi-person-badge'],
            ['Proveedores', 'proveedores', 'Empresas proveedoras', 'bi-truck'],
            ['Productos', 'productos', 'Catálogo base', 'bi-bag'],
            ['Inventario', 'inventario', 'Tallas, colores, stock y precio', 'bi-box-seam'],
            ['Ventas', 'ventas', 'Cabecera de ventas', 'bi-receipt'],
            ['Acceso', 'login', 'Portal de inicio de sesión', 'bi-shield-lock'],
        ];

        render('dashboard/index', [
            'title' => 'Sistema de Gestión de Boutique',
            'cards' => $cards,
        ]);
    }
}
