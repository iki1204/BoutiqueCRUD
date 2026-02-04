<h1>Dashboard Boutique</h1>
<p class="notice">Accede rápidamente a cada módulo y revisa los conteos actuales.</p>
<div class="card-grid">
    <?php foreach ($cards as $card) : ?>
        <div class="card">
            <h3><?= htmlspecialchars($card['label']) ?></h3>
            <p><strong><?= (int) $card['count'] ?></strong> registros</p>
            <a class="btn" href="<?= htmlspecialchars($card['route']) ?>">Ir a módulo</a>
        </div>
    <?php endforeach; ?>
</div>

<h2 class="section-title">Rutas principales</h2>
<ul>
    <li><a href="/?controller=categoria">/categorias</a> - Gestión de categorías.</li>
    <li><a href="/?controller=cliente">/clientes</a> - Gestión de clientes.</li>
    <li><a href="/?controller=empleado">/empleados</a> - Gestión de empleados.</li>
    <li><a href="/?controller=proveedor">/proveedores</a> - Gestión de proveedores.</li>
    <li><a href="/?controller=talla">/tallas</a> - Gestión de tallas.</li>
    <li><a href="/?controller=producto">/productos</a> - Gestión de productos.</li>
    <li><a href="/?controller=ventas">/ventas</a> - Ventas y detalles.</li>
</ul>
