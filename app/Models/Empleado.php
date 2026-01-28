<?php
class Empleado
{
    public static function create(int $id, string $nombre, string $apellido, string $cargo, string $telefono, string $direccion, ?string $fechaIngreso): void
    {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO EMPLEADO (EMPLEADO_ID, NOMBRE, APELLIDO, CARGO, TELEFONO, DIRECCION, FECHA_INGRESO) VALUES (?,?,?,?,?,?,?)');
        $stmt->bind_param('issssss', $id, $nombre, $apellido, $cargo, $telefono, $direccion, $fechaIngreso);
        $stmt->execute();
    }

    public static function update(int $id, string $nombre, string $apellido, string $cargo, string $telefono, string $direccion, ?string $fechaIngreso): void
    {
        global $conn;
        $stmt = $conn->prepare('UPDATE EMPLEADO SET NOMBRE=?, APELLIDO=?, CARGO=?, TELEFONO=?, DIRECCION=?, FECHA_INGRESO=? WHERE EMPLEADO_ID=?');
        $stmt->bind_param('ssssssi', $nombre, $apellido, $cargo, $telefono, $direccion, $fechaIngreso, $id);
        $stmt->execute();
    }

    public static function delete(int $id): void
    {
        global $conn;
        $stmt = $conn->prepare('DELETE FROM EMPLEADO WHERE EMPLEADO_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public static function find(int $id): ?array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM EMPLEADO WHERE EMPLEADO_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ?: null;
    }

    public static function all(): array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM EMPLEADO ORDER BY EMPLEADO_ID DESC');
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
