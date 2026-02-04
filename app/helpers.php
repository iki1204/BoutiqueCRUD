<?php
function h($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

function redirect(string $to): void {
  header("Location: $to");
  exit;
}

function url(string $path = ''): string {
  $config = require __DIR__ . '/config.php';
  $base = rtrim($config['app']['base_url'], '/');
  return $base . $path;
}

function flash_set(string $type, string $message): void {
  if (session_status() !== PHP_SESSION_ACTIVE) session_start();
  $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}
function flash_get(): ?array {
  if (session_status() !== PHP_SESSION_ACTIVE) session_start();
  if (!isset($_SESSION['flash'])) return null;
  $f = $_SESSION['flash'];
  unset($_SESSION['flash']);
  return $f;
}

function csrf_token(): string {
  if (session_status() !== PHP_SESSION_ACTIVE) session_start();
  if (empty($_SESSION['_csrf'])) $_SESSION['_csrf'] = bin2hex(random_bytes(16));
  return $_SESSION['_csrf'];
}
function csrf_check(): void {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
  if (session_status() !== PHP_SESSION_ACTIVE) session_start();
  $token = $_POST['_csrf'] ?? '';
  if (!$token || empty($_SESSION['_csrf']) || !hash_equals($_SESSION['_csrf'], $token)) {
    http_response_code(403);
    echo "CSRF token inválido.";
    exit;
  }
}
