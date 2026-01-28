<?php
require_once __DIR__ . '/app/bootstrap.php';

$routes = require __DIR__ . '/app/routes.php';
$route = $_GET['route'] ?? 'dashboard';

if (!isset($routes[$route])) {
    $route = 'dashboard';
}

$controllerInfo = $routes[$route];
require_once $controllerInfo['controller'];

$controllerClass = $controllerInfo['class'];
$action = $controllerInfo['action'];

$controller = new $controllerClass();
$controller->$action();
