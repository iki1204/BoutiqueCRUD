<?php
class Inventario
{
    public static function create(int $id, int $productoId, string $talla, string $color, int $stock, float $precio): void
    {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO INVENTARIO (INVENTARIO_ID, PRODUCTO_ID, TALLA, COLOR, STOCK, PRECIO) VALUES (?,?,?,?,?,?)');
        $stmt->bind_param('iissid', $id, $productoId, $talla, $color, $stock, $precio);
        $stmt->execute();
    }

    public static function update(int $id, int $productoId, string $talla, string $color, int $stock, float $precio): void
    {
        global $conn;
        $stmt = $conn->prepare('UPDATE INVENTARIO SET PRODUCTO_ID=?, TALLA=?, COLOR=?, STOCK=?, PRECIO=? WHERE INVENTARIO_ID=?');
        $stmt->bind_param('issidi', $productoId, $talla, $color, $stock, $precio, $id);
        $stmt->execute();
    }

    public static function delete(int $id): void
    {
        global $conn;
        $stmt = $conn->prepare('DELETE FROM INVENTARIO WHERE INVENTARIO_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public static function find(int $id): ?array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM INVENTARIO WHERE INVENTARIO_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ?: null;
    }

    public static function allWithProducto(): array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT i.*, p.NOMBRE AS PRODUCTO
                                FROM INVENTARIO i
                                LEFT JOIN PRODUCTO p ON p.PRODUCTO_ID = i.PRODUCTO_ID
                                ORDER BY i.INVENTARIO_ID DESC');
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public static function optionsWithProducto(): array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT i.INVENTARIO_ID AS id,
                                       CONCAT(p.NOMBRE, " - ", i.TALLA, " / ", i.COLOR, " (Stock: ", i.STOCK, ")") AS label,
                                       i.PRECIO AS precio,
                                       i.STOCK AS stock
                                FROM INVENTARIO i
                                LEFT JOIN PRODUCTO p ON p.PRODUCTO_ID = i.PRODUCTO_ID
                                ORDER BY p.NOMBRE, i.TALLA, i.COLOR');
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
