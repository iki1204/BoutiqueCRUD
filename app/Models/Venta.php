<?php
class Venta
{
    public static function create(int $id, int $clienteId, int $empleadoId, ?string $fecha, float $total, string $metodoPago): void
    {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO VENTAS (VENTA_ID, CLIENTE_ID, EMPLEADO_ID, FECHA, TOTAL, METODO_PAGO) VALUES (?,?,?,?,?,?)');
        $stmt->bind_param('iiisds', $id, $clienteId, $empleadoId, $fecha, $total, $metodoPago);
        $stmt->execute();
    }

    public static function update(int $id, int $clienteId, int $empleadoId, ?string $fecha, float $total, string $metodoPago): void
    {
        global $conn;
        $stmt = $conn->prepare('UPDATE VENTAS SET CLIENTE_ID=?, EMPLEADO_ID=?, FECHA=?, TOTAL=?, METODO_PAGO=? WHERE VENTA_ID=?');
        $stmt->bind_param('iisdsi', $clienteId, $empleadoId, $fecha, $total, $metodoPago, $id);
        $stmt->execute();
    }

    public static function delete(int $id): void
    {
        global $conn;
        $stmt = $conn->prepare('DELETE FROM VENTAS WHERE VENTA_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public static function find(int $id): ?array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM VENTAS WHERE VENTA_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ?: null;
    }

    public static function allWithDetalles(): array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT v.*,
                                       dv.DETALLE_ID,
                                       dv.INVENTARIO_ID,
                                       dv.CANTIDAD,
                                       dv.PRECIO_UNITARIO,
                                       c.NOMBRE AS CLIENTE,
                                       e.NOMBRE AS EMPLEADO,
                                       p.NOMBRE AS PRODUCTO,
                                       i.TALLA,
                                       i.COLOR,
                                       i.STOCK
                                FROM VENTAS v
                                LEFT JOIN CLIENTE c ON c.CLIENTE_ID = v.CLIENTE_ID
                                LEFT JOIN EMPLEADO e ON e.EMPLEADO_ID = v.EMPLEADO_ID
                                LEFT JOIN DETALLE_VENTA dv ON dv.VENTA_ID = v.VENTA_ID
                                LEFT JOIN INVENTARIO i ON i.INVENTARIO_ID = dv.INVENTARIO_ID
                                LEFT JOIN PRODUCTO p ON p.PRODUCTO_ID = i.PRODUCTO_ID
                                ORDER BY v.VENTA_ID DESC, dv.DETALLE_ID ASC');
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
