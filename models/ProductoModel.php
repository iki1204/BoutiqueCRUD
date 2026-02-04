<?php

declare(strict_types=1);

class ProductoModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $sql = 'SELECT p.*, c.DESCRIPCION AS CATEGORIA, t.DESCRIPCION AS TALLA, pr.NOMBRE_EMPRESA AS PROVEEDOR
                FROM _CODE_PRODUCTO p
                INNER JOIN _CODE_CATEGORIA c ON p.CATEGORIA_ID = c.CATEGORIA_ID
                INNER JOIN _CODE_TALLA t ON p.TALLA_ID = t.TALLA_ID
                INNER JOIN _CODE_PROVEEDOR pr ON p.PROVEEDOR_ID = pr.PROVEEDOR_ID
                ORDER BY p.PRODUCTO_ID ASC';
        return $this->db->query($sql)->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM _CODE_PRODUCTO WHERE PRODUCTO_ID = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO _CODE_PRODUCTO (PRODUCTO_ID, CATEGORIA_ID, PROVEEDOR_ID, TALLA_ID, CODIGO, DESCRIPCION, COLOR, MARCA, STOCK, PRECIO)
             VALUES (:id, :categoria, :proveedor, :talla, :codigo, :descripcion, :color, :marca, :stock, :precio)'
        );
        $stmt->execute([
            'id' => $data['PRODUCTO_ID'],
            'categoria' => $data['CATEGORIA_ID'],
            'proveedor' => $data['PROVEEDOR_ID'],
            'talla' => $data['TALLA_ID'],
            'codigo' => $data['CODIGO'],
            'descripcion' => $data['DESCRIPCION'],
            'color' => $data['COLOR'],
            'marca' => $data['MARCA'],
            'stock' => $data['STOCK'],
            'precio' => $data['PRECIO'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare(
            'UPDATE _CODE_PRODUCTO
             SET CATEGORIA_ID = :categoria,
                 PROVEEDOR_ID = :proveedor,
                 TALLA_ID = :talla,
                 CODIGO = :codigo,
                 DESCRIPCION = :descripcion,
                 COLOR = :color,
                 MARCA = :marca,
                 STOCK = :stock,
                 PRECIO = :precio
             WHERE PRODUCTO_ID = :id'
        );
        $stmt->execute([
            'id' => $id,
            'categoria' => $data['CATEGORIA_ID'],
            'proveedor' => $data['PROVEEDOR_ID'],
            'talla' => $data['TALLA_ID'],
            'codigo' => $data['CODIGO'],
            'descripcion' => $data['DESCRIPCION'],
            'color' => $data['COLOR'],
            'marca' => $data['MARCA'],
            'stock' => $data['STOCK'],
            'precio' => $data['PRECIO'],
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM _CODE_PRODUCTO WHERE PRODUCTO_ID = :id');
        $stmt->execute(['id' => $id]);
    }

    public function count(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM _CODE_PRODUCTO');
        return (int) $stmt->fetchColumn();
    }
}
