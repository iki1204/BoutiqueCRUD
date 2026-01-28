<?php
class Producto
{
    public static function create(int $id, int $categoriaId, int $proveedorId, string $nombre, string $descripcion, string $color, string $marca): void
    {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO PRODUCTO (PRODUCTO_ID, CATEGORIA_ID, PROVEEDOR_ID, NOMBRE, DESCRIPCION, COLOR, MARCA) VALUES (?,?,?,?,?,?,?)');
        $stmt->bind_param('iiissss', $id, $categoriaId, $proveedorId, $nombre, $descripcion, $color, $marca);
        $stmt->execute();
    }

    public static function update(int $id, int $categoriaId, int $proveedorId, string $nombre, string $descripcion, string $color, string $marca): void
    {
        global $conn;
        $stmt = $conn->prepare('UPDATE PRODUCTO SET CATEGORIA_ID=?, PROVEEDOR_ID=?, NOMBRE=?, DESCRIPCION=?, COLOR=?, MARCA=? WHERE PRODUCTO_ID=?');
        $stmt->bind_param('iissssi', $categoriaId, $proveedorId, $nombre, $descripcion, $color, $marca, $id);
        $stmt->execute();
    }

    public static function delete(int $id): void
    {
        global $conn;
        $stmt = $conn->prepare('DELETE FROM PRODUCTO WHERE PRODUCTO_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public static function find(int $id): ?array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM PRODUCTO WHERE PRODUCTO_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ?: null;
    }

    public static function allWithRelations(): array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT p.*, c.NOMBRE AS CATEGORIA, pr.NOMBRE_EMPRESA AS PROVEEDOR
                                FROM PRODUCTO p
                                LEFT JOIN CATEGORIA c ON c.CATEGORIA_ID = p.CATEGORIA_ID
                                LEFT JOIN PROVEEDOR pr ON pr.PROVEEDOR_ID = p.PROVEEDOR_ID
                                ORDER BY p.PRODUCTO_ID DESC');
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
