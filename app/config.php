<?php
return [
  'db' => [
    'host' => getenv('DB_HOST') ?: '127.0.0.1',
    'name' => getenv('DB_NAME') ?: 'boutique',
    'user' => getenv('DB_USER') ?: 'root',
    'pass' => getenv('DB_PASS') ?: '',
    'charset' => 'utf8mb4',
  ],
  'app' => [
    'name' => 'Boutique Admin',
    'base_url' => '/BoutiqueCrud', // si lo despliegas en subcarpeta, ej: '/boutique_crud/public'
  ],
];
