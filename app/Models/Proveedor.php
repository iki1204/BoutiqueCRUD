<?php
class Proveedor
{
    public static function create(int $id, string $empresa, string $telefono, string $email, string $direccion, string $ciudad): void
    {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO PROVEEDOR (PROVEEDOR_ID, NOMBRE_EMPRESA, TELEFONO, EMAIL, DIRECCION, CIUDAD) VALUES (?,?,?,?,?,?)');
        $stmt->bind_param('isssss', $id, $empresa, $telefono, $email, $direccion, $ciudad);
        $stmt->execute();
    }

    public static function update(int $id, string $empresa, string $telefono, string $email, string $direccion, string $ciudad): void
    {
        global $conn;
        $stmt = $conn->prepare('UPDATE PROVEEDOR SET NOMBRE_EMPRESA=?, TELEFONO=?, EMAIL=?, DIRECCION=?, CIUDAD=? WHERE PROVEEDOR_ID=?');
        $stmt->bind_param('sssssi', $empresa, $telefono, $email, $direccion, $ciudad, $id);
        $stmt->execute();
    }

    public static function delete(int $id): void
    {
        global $conn;
        $stmt = $conn->prepare('DELETE FROM PROVEEDOR WHERE PROVEEDOR_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public static function find(int $id): ?array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM PROVEEDOR WHERE PROVEEDOR_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ?: null;
    }

    public static function all(): array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM PROVEEDOR ORDER BY PROVEEDOR_ID DESC');
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
