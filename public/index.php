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

$controllerName = $_GET['controller'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

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
