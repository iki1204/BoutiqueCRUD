<?php
require_once __DIR__ . '/../helpers.php';
$config = require __DIR__ . '/../config.php';
$meta = require __DIR__ . '/../meta.php';
$flash = flash_get();
$m = $_GET['m'] ?? '';
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h($config['app']['name']) ?><?= $page_title ? ' · ' . h($page_title) : '' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?= url('/assets/css/app.css') ?>" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="d-flex" style="min-height:100vh;">
    <aside class="sidebar border-end bg-white">
      <div class="p-3 border-bottom">
        <div class="d-flex align-items-center gap-2">
          <span class="badge bg-primary rounded-pill">Admin</span>
          <div>
            <div class="fw-semibold"><?= h($config['app']['name']) ?></div>
            <div class="text-muted small">Dashboard & CRUD</div>
          </div>
        </div>
      </div>
      <div class="p-2">
        <a class="nav-link px-3 py-2 rounded <?= $m==''?'active':'' ?>" href="<?= url('/public/index.php') ?>">
          <i class="bi bi-speedometer2 me-2"></i>Inicio
        </a>
        <div class="text-uppercase small text-muted px-3 mt-3 mb-1">Gestión</div>
        <?php foreach ($meta as $key => $def): ?>
          <a class="nav-link px-3 py-2 rounded <?= $m===$key?'active':'' ?>" href="<?= url('/public/index.php?m=' . $key) ?>">
            <i class="bi bi-table me-2"></i><?= h($def['title']) ?>
          </a>
        <?php endforeach; ?>
      </div>
      <div class="mt-auto p-3 border-top text-muted small">
        <?= date('Y') ?> · Boutique CRUD
      </div>
    </aside>

    <main class="flex-grow-1">
      <header class="bg-white border-bottom">
        <div class="container-fluid py-3 d-flex align-items-center justify-content-between">
          <div>
            <div class="fw-semibold"><?= h($page_title ?? 'Dashboard') ?></div>
            <div class="text-muted small"><?= h($page_subtitle ?? 'Panel de administración') ?></div>
          </div>
          <div class="d-flex gap-2">
            <a class="btn btn-outline-secondary btn-sm" href="<?= url('/public/index.php') ?>"><i class="bi bi-house"></i></a>
            <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#helpCanvas">
              <i class="bi bi-question-circle"></i>
            </button>
          </div>
        </div>
      </header>

      <div class="container-fluid py-4">
        <?php if ($flash): ?>
          <div class="alert alert-<?= h($flash['type']) ?>"><?= h($flash['message']) ?></div>
        <?php endif; ?>

        <?= $content ?>

        <div class="text-center text-muted small mt-5">
          Hecho con PHP + Bootstrap · <?= date('Y-m-d') ?>
        </div>
      </div>
    </main>
  </div>

  <div class="offcanvas offcanvas-end" tabindex="-1" id="helpCanvas">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Ayuda rápida</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <p class="mb-2"><strong>Instalación</strong></p>
      <ol class="small">
        <li>Crea la BD <code>boutique</code> en MySQL.</li>
        <li>Importa <code>db/schema.sql</code>.</li>
        <li>Opcional: importa <code>db/seed.sql</code> para datos de ejemplo.</li>
        <li>Ajusta credenciales en <code>app/config.php</code>.</li>
        <li>Levanta con Apache (XAMPP) apuntando a <code>/public</code>.</li>
      </ol>
      <hr>
      <p class="small text-muted">Nota: En tu modelo la PK no es auto-increment. Por eso, el módulo de ventas calcula el siguiente ID con <code>MAX()+1</code>.</p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= url('/assets/js/app.js') ?>"></script>
</body>
</html>
