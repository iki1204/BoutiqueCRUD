<?php

declare(strict_types=1);

spl_autoload_register(function (string $class): void {
    $paths = [
        __DIR__ . '/../controllers/' . $class . '.php',
        __DIR__ . '/../models/' . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require $path;
            return;
        }
    }
});

$controllerName = $_GET['controller'] ?? null;
$action = $_GET['action'] ?? null;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
$path = rtrim($path, '/') ?: '/';

$routeMap = [
    '/' => ['controller' => 'dashboard', 'action' => 'index'],
    '/dashboard' => ['controller' => 'dashboard', 'action' => 'index'],
    '/categorias' => ['controller' => 'categoria', 'action' => 'index'],
    '/clientes' => ['controller' => 'cliente', 'action' => 'index'],
    '/empleados' => ['controller' => 'empleado', 'action' => 'index'],
    '/proveedores' => ['controller' => 'proveedor', 'action' => 'index'],
    '/tallas' => ['controller' => 'talla', 'action' => 'index'],
    '/productos' => ['controller' => 'producto', 'action' => 'index'],
    '/ventas' => ['controller' => 'ventas', 'action' => 'index'],
];

if ($controllerName === null && $action === null) {
    if (isset($routeMap[$path])) {
        $controllerName = $routeMap[$path]['controller'];
        $action = $routeMap[$path]['action'];
    } else {
        $segments = array_values(array_filter(explode('/', $path)));
        $segmentMap = [
            'categorias' => 'categoria',
            'clientes' => 'cliente',
            'empleados' => 'empleado',
            'proveedores' => 'proveedor',
            'tallas' => 'talla',
            'productos' => 'producto',
            'ventas' => 'ventas',
            'dashboard' => 'dashboard',
        ];
        $actionMap = [
            'crear' => 'create',
            'editar' => 'edit',
            'eliminar' => 'delete',
        ];
        if (!empty($segments) && isset($segmentMap[$segments[0]])) {
            $controllerName = $segmentMap[$segments[0]];
            $action = $actionMap[$segments[1] ?? ''] ?? 'index';
            if ($action === 'edit' && isset($segments[2])) {
                $_GET['id'] = $segments[2];
            }
        }
    }
}

$controllerName ??= 'dashboard';
$action ??= 'index';

$controllerMap = [
    'dashboard' => DashboardController::class,
    'categoria' => CategoriaController::class,
    'cliente' => ClienteController::class,
    'empleado' => EmpleadoController::class,
    'proveedor' => ProveedorController::class,
    'talla' => TallaController::class,
    'producto' => ProductoController::class,
    'ventas' => VentasController::class,
];

if (!array_key_exists($controllerName, $controllerMap)) {
    http_response_code(404);
    echo 'Controlador no encontrado.';
    exit;
}

$controllerClass = $controllerMap[$controllerName];
$controller = new $controllerClass();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    echo 'Acción no encontrada.';
    exit;
}

$controller->$action();
