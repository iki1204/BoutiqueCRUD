<section class="app-hero mb-4 shadow-sm">
  <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-3">
    <div>
      <p class="text-uppercase small fw-semibold mb-2">Dashboard</p>
      <h2 class="fw-bold mb-2">Bienvenido al panel de gestión</h2>
      <p class="mb-0 opacity-75">Centraliza el control de clientes, inventario y ventas con accesos rápidos.</p>
    </div>
    <div class="d-flex gap-2">
      <a class="btn btn-light app-action" href="index.php?route=ventas">
        <i class="bi bi-receipt me-2"></i>Ver ventas
      </a>
      <a class="btn btn-outline-light app-action" href="index.php?route=productos">
        <i class="bi bi-bag me-2"></i>Productos
      </a>
    </div>
  </div>
</section>

<div class="row g-3">
  <?php foreach ($cards as [$t, $route, $d, $icon]): ?>
   <div class="card h-100 shadow-sm app-card">
      <div class="card-body d-flex flex-column gap-3">
        <div class="d-flex align-items-center justify-content-between">
          <span class="icon-wrap">
            <i class="bi <?= h($icon) ?>"></i>
          </span>
          <span class="badge text-bg-light">Nuevo</span>
        </div>
        <div>
          <h5 class="card-title mb-2"><?= h($t) ?></h5>
          <p class="card-text text-muted mb-0"><?= h($d) ?></p>
        </div>
        <div class="mt-auto">
          <a class="btn btn-primary app-action" href="index.php?route=<?= h($route) ?>">
            Ir al módulo
            <i class="bi bi-arrow-up-right ms-1"></i>
          </a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
