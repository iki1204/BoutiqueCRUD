<?php
// db.php (PDO)
$config = require __DIR__ . '/config.php';
$db = $config['db'];

$dsn = "mysql:host={$db['host']};dbname={$db['name']};charset={$db['charset']}";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];

try {
  $pdo = new PDO($dsn, $db['user'], $db['pass'], $options);
} catch (PDOException $e) {
  http_response_code(500);
  echo "<h1>Error de conexión</h1>";
  echo "<p>Revisa app/config.php o variables de entorno DB_HOST/DB_NAME/DB_USER/DB_PASS.</p>";
  echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
  exit;
}
