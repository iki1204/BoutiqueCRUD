<h1>Dashboard Boutique</h1>
<p class="notice">Accede rápidamente a cada módulo y revisa los conteos actuales.</p>
<div class="card-grid">
    <?php foreach ($cards as $card) : ?>
        <?php $cardData = $card; ?>
        <?php require __DIR__ . '/' . $card['view'] . '.php'; ?>
    <?php endforeach; ?>
</div>

<h2 class="section-title">Rutas principales</h2>
<ul>
    <li><a href="/categorias">/categorias</a> - Gestión de categorías.</li>
    <li><a href="/clientes">/clientes</a> - Gestión de clientes.</li>
    <li><a href="/empleados">/empleados</a> - Gestión de empleados.</li>
    <li><a href="/proveedores">/proveedores</a> - Gestión de proveedores.</li>
    <li><a href="/tallas">/tallas</a> - Gestión de tallas.</li>
    <li><a href="/productos">/productos</a> - Gestión de productos.</li>
    <li><a href="/ventas">/ventas</a> - Ventas y detalles.</li>
</ul>
