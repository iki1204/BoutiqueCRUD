<div class="row g-3">
  <?php foreach ($cards as [$t, $route, $d]): ?>
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><?= h($t) ?></h5>
          <p class="card-text"><?= h($d) ?></p>
          <a class="btn btn-primary" href="index.php?route=<?= h($route) ?>">Abrir</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
