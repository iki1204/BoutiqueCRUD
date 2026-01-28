<?php
class DetalleVenta
{
    public static function create(int $ventaId, int $inventarioId, int $cantidad, float $precioUnitario): void
    {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO DETALLE_VENTA (VENTA_ID, INVENTARIO_ID, CANTIDAD, PRECIO_UNITARIO) VALUES (?,?,?,?)');
        $stmt->bind_param('iiid', $ventaId, $inventarioId, $cantidad, $precioUnitario);
        $stmt->execute();
    }

    public static function updateByVenta(int $ventaId, int $inventarioId, int $cantidad, float $precioUnitario): void
    {
        global $conn;
        $stmt = $conn->prepare('UPDATE DETALLE_VENTA SET INVENTARIO_ID=?, CANTIDAD=?, PRECIO_UNITARIO=? WHERE VENTA_ID=?');
        $stmt->bind_param('iidi', $inventarioId, $cantidad, $precioUnitario, $ventaId);
        $stmt->execute();
    }

    public static function deleteByVenta(int $ventaId): void
    {
        global $conn;
        $stmt = $conn->prepare('DELETE FROM DETALLE_VENTA WHERE VENTA_ID=?');
        $stmt->bind_param('i', $ventaId);
        $stmt->execute();
    }

    public static function findByVenta(int $ventaId): ?array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM DETALLE_VENTA WHERE VENTA_ID=?');
        $stmt->bind_param('i', $ventaId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ?: null;
    }
}