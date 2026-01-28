<?php
return [
    'dashboard' => [
        'controller' => __DIR__ . '/Controllers/DashboardController.php',
        'class' => 'DashboardController',
        'action' => 'index',
    ],
    'categorias' => [
        'controller' => __DIR__ . '/Controllers/CategoriasController.php',
        'class' => 'CategoriasController',
        'action' => 'index',
    ],
    'clientes' => [
        'controller' => __DIR__ . '/Controllers/ClientesController.php',
        'class' => 'ClientesController',
        'action' => 'index',
    ],
    'empleados' => [
        'controller' => __DIR__ . '/Controllers/EmpleadosController.php',
        'class' => 'EmpleadosController',
        'action' => 'index',
    ],
    'proveedores' => [
        'controller' => __DIR__ . '/Controllers/ProveedoresController.php',
        'class' => 'ProveedoresController',
        'action' => 'index',
    ],
    'productos' => [
        'controller' => __DIR__ . '/Controllers/ProductosController.php',
        'class' => 'ProductosController',
        'action' => 'index',
    ],
    'inventario' => [
        'controller' => __DIR__ . '/Controllers/InventarioController.php',
        'class' => 'InventarioController',
        'action' => 'index',
    ],
    'ventas' => [
        'controller' => __DIR__ . '/Controllers/VentasController.php',
        'class' => 'VentasController',
        'action' => 'index',
    ],
];
