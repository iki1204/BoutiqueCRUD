<?php
require_once __DIR__ . '/consultas.php';
page_header('Sistema de Gestión de Boutique');
?>
<div class="row g-3">
  <?php
  $cards = [
    ['Categorías','categorias.php','Administra categorías de productos'],
    ['Clientes','clientes.php','Clientes registrados'],
    ['Empleados','empleados.php','Personal y cargos'],
    ['Proveedores','proveedores.php','Empresas proveedoras'],
    ['Productos','productos.php','Catálogo base'],
    ['Inventario','inventario.php','Tallas, colores, stock y precio'],
    ['Ventas','ventas.php','Cabecera de ventas'],
  ];
  foreach ($cards as [$t,$href,$d]): ?>
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><?= h($t) ?></h5>
          <p class="card-text"><?= h($d) ?></p>
          <a class="btn btn-primary" href="<?= h($href) ?>">Abrir</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php page_footer();
