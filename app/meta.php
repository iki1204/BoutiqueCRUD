<?php
// meta.php: definición de módulos/tablas para el dashboard y CRUD genérico.
return [
  'categoria' => [
    'title' => 'Categorías',
    'table' => '_CODE_CATEGORIA',
    'pk' => 'CATEGORIA_ID',
    'columns' => [
      'CATEGORIA_ID' => ['label' => 'ID', 'type' => 'number', 'readonly' => true],
      'CODIGO' => ['label' => 'Código', 'type' => 'text', 'required' => true],
      'DESCRIPCION' => ['label' => 'Descripción', 'type' => 'text', 'required' => true],
    ],
  ],
  'talla' => [
    'title' => 'Tallas',
    'table' => '_CODE_TALLA',
    'pk' => 'TALLA_ID',
    'columns' => [
      'TALLA_ID' => ['label' => 'ID', 'type' => 'number', 'readonly' => true],
      'CODIGO' => ['label' => 'Código', 'type' => 'text', 'required' => true],
      'DESCRIPCION' => ['label' => 'Descripción', 'type' => 'text', 'required' => true],
    ],
  ],
  'proveedor' => [
    'title' => 'Proveedores',
    'table' => '_CODE_PROVEEDOR',
    'pk' => 'PROVEEDOR_ID',
    'columns' => [
      'PROVEEDOR_ID' => ['label' => 'ID', 'type' => 'number', 'readonly' => true],
      'NOMBRE_EMPRESA' => ['label' => 'Empresa', 'type' => 'text', 'required' => true],
      'TELEFONO' => ['label' => 'Teléfono', 'type' => 'text'],
      'EMAIL' => ['label' => 'Email', 'type' => 'email'],
      'DIRECCION' => ['label' => 'Dirección', 'type' => 'text'],
      'CIUDAD' => ['label' => 'Ciudad', 'type' => 'text'],
    ],
  ],
  'cliente' => [
    'title' => 'Clientes',
    'table' => '_CODE_CLIENTE',
    'pk' => 'CLIENTE_ID',
    'columns' => [
      'CLIENTE_ID' => ['label' => 'ID', 'type' => 'number', 'readonly' => true],
      'CODIGO' => ['label' => 'Código', 'type' => 'text', 'required' => true],
      'APELLIDO' => ['label' => 'Apellido', 'type' => 'text', 'required' => true],
      'TELEFONO' => ['label' => 'Teléfono', 'type' => 'text'],
      'EMAIL' => ['label' => 'Email', 'type' => 'email'],
      'DIRECCION' => ['label' => 'Dirección', 'type' => 'text'],
    ],
  ],
  'empleado' => [
    'title' => 'Empleados',
    'table' => '_CODE_EMPLEADO',
    'pk' => 'EMPLEADO_ID',
    'columns' => [
      'EMPLEADO_ID' => ['label' => 'ID', 'type' => 'number', 'readonly' => true],
      'CODIGO' => ['label' => 'Código', 'type' => 'text', 'required' => true],
      'APELLIDO' => ['label' => 'Apellido', 'type' => 'text', 'required' => true],
      'CARGO' => ['label' => 'Cargo', 'type' => 'text'],
      'TELEFONO' => ['label' => 'Teléfono', 'type' => 'text'],
      'DIRECCION' => ['label' => 'Dirección', 'type' => 'text'],
      'FECHA_INGRESO' => ['label' => 'Fecha ingreso', 'type' => 'date'],
    ],
  ],
  'producto' => [
    'title' => 'Productos',
    'table' => '_CODE_PRODUCTO',
    'pk' => 'PRODUCTO_ID',
    'columns' => [
      'PRODUCTO_ID' => ['label' => 'ID', 'type' => 'number', 'readonly' => true],
      'CATEGORIA_ID' => ['label' => 'Categoría', 'type' => 'fk', 'required' => true, 'ref' => ['_CODE_CATEGORIA','CATEGORIA_ID','DESCRIPCION']],
      'PROVEEDOR_ID' => ['label' => 'Proveedor', 'type' => 'fk', 'required' => true, 'ref' => ['_CODE_PROVEEDOR','PROVEEDOR_ID','NOMBRE_EMPRESA']],
      'TALLA_ID' => ['label' => 'Talla', 'type' => 'fk', 'required' => true, 'ref' => ['_CODE_TALLA','TALLA_ID','DESCRIPCION']],
      'CODIGO' => ['label' => 'Código', 'type' => 'text', 'required' => true],
      'DESCRIPCION' => ['label' => 'Descripción', 'type' => 'text', 'required' => true],
      'COLOR' => ['label' => 'Color', 'type' => 'text'],
      'MARCA' => ['label' => 'Marca', 'type' => 'text'],
      'STOCK' => ['label' => 'Stock', 'type' => 'number', 'required' => true],
      'PRECIO' => ['label' => 'Precio', 'type' => 'number', 'step' => '0.01', 'required' => true],
    ],
  ],
  // Ventas y Detalle Venta se manejan con módulos dedicados (por la lógica transaccional)
  'ventas' => [
    'title' => 'Ventas',
    'module' => 'ventas',
  ],
  'detalle_venta' => [
    'title' => 'Detalle de Venta',
    'module' => 'detalle_venta',
  ],
];
