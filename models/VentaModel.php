<?php

declare(strict_types=1);

class VentaModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT v.VENTA_ID, v.FECHA, v.TOTAL, v.ESTADO, v.METODO_PAGO,
                       c.APELLIDO AS CLIENTE, e.APELLIDO AS EMPLEADO
                FROM _CODE_VENTAS v
                INNER JOIN _CODE_CLIENTE c ON v.CLIENTE_ID = c.CLIENTE_ID
                INNER JOIN _CODE_EMPLEADO e ON v.EMPLEADO_ID = e.EMPLEADO_ID
                ORDER BY v.VENTA_ID ASC";
        return $this->db->query($sql)->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT v.*, c.APELLIDO AS CLIENTE, e.APELLIDO AS EMPLEADO
             FROM _CODE_VENTAS v
             INNER JOIN _CODE_CLIENTE c ON v.CLIENTE_ID = c.CLIENTE_ID
             INNER JOIN _CODE_EMPLEADO e ON v.EMPLEADO_ID = e.EMPLEADO_ID
             WHERE v.VENTA_ID = :id"
        );
        $stmt->execute(['id' => $id]);
        $venta = $stmt->fetch();
        if (!$venta) {
            return null;
        }

        $detalleStmt = $this->db->prepare(
            "SELECT d.DETALLE_ID, d.PRODUCTO_ID, d.CANTIDAD, d.PRECIO, p.DESCRIPCION AS PRODUCTO
             FROM _CODE_DETALLE_VENTA d
             INNER JOIN _CODE_PRODUCTO p ON d.PRODUCTO_ID = p.PRODUCTO_ID
             WHERE d.VENTA_ID = :id
             ORDER BY d.DETALLE_ID ASC"
        );
        $detalleStmt->execute(['id' => $id]);
        $venta['DETALLE'] = $detalleStmt->fetchAll();

        return $venta;
    }

    public function create(array $ventaData, array $detalles): int
    {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO _CODE_VENTAS (CLIENTE_ID, EMPLEADO_ID, FECHA, TOTAL, ESTADO, METODO_PAGO)
                 VALUES (:cliente, :empleado, :fecha, :total, :estado, :metodo)"
            );
            $stmt->execute([
                'cliente' => $ventaData['CLIENTE_ID'],
                'empleado' => $ventaData['EMPLEADO_ID'],
                'fecha' => $ventaData['FECHA'],
                'total' => $ventaData['TOTAL'],
                'estado' => $ventaData['ESTADO'],
                'metodo' => $ventaData['METODO_PAGO'],
            ]);
            $ventaId = (int) $this->db->lastInsertId();

            $this->insertDetalles($ventaId, $detalles);
            $this->db->commit();

            return $ventaId;
        } catch (Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function update(int $ventaId, array $ventaData, array $detalles): void
    {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare(
                "UPDATE _CODE_VENTAS
                 SET CLIENTE_ID = :cliente,
                     EMPLEADO_ID = :empleado,
                     FECHA = :fecha,
                     TOTAL = :total,
                     ESTADO = :estado,
                     METODO_PAGO = :metodo
                 WHERE VENTA_ID = :id"
            );
            $stmt->execute([
                'cliente' => $ventaData['CLIENTE_ID'],
                'empleado' => $ventaData['EMPLEADO_ID'],
                'fecha' => $ventaData['FECHA'],
                'total' => $ventaData['TOTAL'],
                'estado' => $ventaData['ESTADO'],
                'metodo' => $ventaData['METODO_PAGO'],
                'id' => $ventaId,
            ]);

            $deleteStmt = $this->db->prepare("DELETE FROM _CODE_DETALLE_VENTA WHERE VENTA_ID = :id");
            $deleteStmt->execute(['id' => $ventaId]);

            $this->insertDetalles($ventaId, $detalles);
            $this->db->commit();
        } catch (Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function delete(int $ventaId): void
    {
        $this->db->beginTransaction();
        try {
            $deleteDetalle = $this->db->prepare("DELETE FROM _CODE_DETALLE_VENTA WHERE VENTA_ID = :id");
            $deleteDetalle->execute(['id' => $ventaId]);

            $deleteVenta = $this->db->prepare("DELETE FROM _CODE_VENTAS WHERE VENTA_ID = :id");
            $deleteVenta->execute(['id' => $ventaId]);
            $this->db->commit();
        } catch (Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    private function insertDetalles(int $ventaId, array $detalles): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO _CODE_DETALLE_VENTA (VENTA_ID, PRODUCTO_ID, CANTIDAD, PRECIO)
             VALUES (:venta, :producto, :cantidad, :precio)"
        );
        foreach ($detalles as $detalle) {
            $stmt->execute([
                'venta' => $ventaId,
                'producto' => $detalle['PRODUCTO_ID'],
                'cantidad' => $detalle['CANTIDAD'],
                'precio' => $detalle['PRECIO'],
            ]);
        }
    }
}
