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
    <li><a href="/?controller=categoria">Categorías</a> - Gestión de categorías.</li>
    <li><a href="/?controller=cliente">Clientes</a> - Gestión de clientes.</li>
    <li><a href="/?controller=empleado">Empleados</a> - Gestión de empleados.</li>
    <li><a href="/?controller=proveedor">Proveedores</a> - Gestión de proveedores.</li>
    <li><a href="/?controller=talla">Tallas</a> - Gestión de tallas.</li>
    <li><a href="/?controller=producto">Productos</a> - Gestión de productos.</li>
    <li><a href="/?controller=ventas">Ventas</a> - Ventas y detalles.</li>
</ul>
