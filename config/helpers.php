<?php
function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

function flash_set(string $type, string $message): void {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function flash_get(): ?array {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $f = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $f;
}

function redirect(string $to): void {
    header('Location: ' . $to);
    exit;
}

function render(string $view, array $data = []): void {
    extract($data, EXTR_SKIP);
    require __DIR__ . '/../app/Views/layout/header.php';
    require __DIR__ . '/../app/Views/' . $view . '.php';
    require __DIR__ . '/../app/Views/layout/footer.php';
}

function fetch_all_assoc(mysqli_stmt $stmt): array {
    $result = $stmt->get_result();
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function get_options(string $table, string $idCol, string $labelCol): array {
    global $conn;
    $sql = "SELECT $idCol AS id, $labelCol AS label FROM $table ORDER BY $labelCol";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return fetch_all_assoc($stmt);
}
