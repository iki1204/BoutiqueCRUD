<?php
$flash = flash_get();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= h($title ?? 'Sistema de Gestión') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fb;
        }
        .app-hero {
            background: linear-gradient(120deg, #1c6dd0 0%, #5e72e4 100%);
            color: #fff;
            border-radius: 1rem;
            padding: 2rem;
        }
        .app-card {
            border: 0;
            border-radius: 1rem;
        }
        .app-card .icon-wrap {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(94, 114, 228, 0.12);
            color: #3c4fd8;
            font-size: 1.4rem;
        }
        .app-action {
            border-radius: 999px;
            padding-inline: 1.25rem;
        }
    </style>
</head>
<body class="bg-light">
<main class="container py-4">
    <h1 class="h3 mb-3"><?= h($title ?? '') ?></h1>
    <?php if ($flash): ?>
        <div class="alert alert-<?= h($flash['type']) ?> alert-dismissible fade show" role="alert">
            <?= h($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
