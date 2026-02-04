<?php
    $viewFile = __DIR__ . '/' . $viewPath . '.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique CRUD</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f5f5f5; color: #1f2937; }
        header { background: #1f2937; color: #fff; padding: 16px 24px; }
        nav a { color: #fff; margin-right: 16px; text-decoration: none; font-weight: 600; }
        main { padding: 24px; }
        .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; }
        .card { background: #fff; border-radius: 8px; padding: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.08); }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { padding: 10px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        th { background: #f3f4f6; }
        .actions { display: flex; gap: 8px; }
        form.inline { display: inline; }
        .btn { padding: 8px 12px; border-radius: 6px; border: none; cursor: pointer; text-decoration: none; color: #fff; background: #2563eb; }
        .btn.secondary { background: #6b7280; }
        .btn.danger { background: #dc2626; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; }
        label { font-weight: 600; display: block; margin-bottom: 6px; }
        input, select { width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #d1d5db; }
        .section-title { margin-top: 24px; }
        .detail-row { display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 12px; align-items: end; }
        .notice { background: #fef3c7; padding: 12px; border-radius: 6px; margin-bottom: 16px; }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="/dashboard">Dashboard</a>
            <a href="/categorias">Categorías</a>
            <a href="/clientes">Clientes</a>
            <a href="/empleados">Empleados</a>
            <a href="/proveedores">Proveedores</a>
            <a href="/tallas">Tallas</a>
            <a href="/productos">Productos</a>
            <a href="/ventas">Ventas</a>
        </nav>
    </header>
    <main>
        <?php if (file_exists($viewFile)) : ?>
            <?php require $viewFile; ?>
        <?php else : ?>
            <p>Vista no encontrada.</p>
        <?php endif; ?>
    </main>
</body>
</html>
