# Boutique CRUD (PHP + Bootstrap)

Incluye:
- Dashboard profesional (sidebar + cards).
- CRUD por tabla: categorías, tallas, proveedores, clientes, empleados, productos.
- Módulo **Ventas** con creación transaccional (venta + detalle_venta) y ajuste de stock.
- Módulo **Detalle de venta** (tabla transitiva) con filtro por venta y eliminación con ajuste de total/stock.

## 1) Crear la base de datos

En MySQL:
- Crea una base: `boutique`
- Importa: `db/schema.sql`
- (Opcional) Importa: `db/seed.sql`

> Nota: Tu schema no usa AUTO_INCREMENT en las PK. Este proyecto mantiene eso y, para Ventas/Detalle, calcula IDs con `MAX()+1`.

## 2) Configurar credenciales
Edita `app/config.php` o usa variables de entorno:
- `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`

## 3) Ejecutar (XAMPP)
Copia la carpeta del proyecto a `htdocs` y abre:
- `http://localhost/boutique_crud/public/`

## Recomendación
Para producción, añade autenticación (login) y roles.
