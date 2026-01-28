<?php
class Cliente
{
    public static function create(int $id, string $nombre, string $apellido, string $telefono, string $email, string $direccion): void
    {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO CLIENTE (CLIENTE_ID, NOMBRE, APELLIDO, TELEFONO, EMAIL, DIRECCION) VALUES (?,?,?,?,?,?)');
        $stmt->bind_param('isssss', $id, $nombre, $apellido, $telefono, $email, $direccion);
        $stmt->execute();
    }

    public static function update(int $id, string $nombre, string $apellido, string $telefono, string $email, string $direccion): void
    {
        global $conn;
        $stmt = $conn->prepare('UPDATE CLIENTE SET NOMBRE=?, APELLIDO=?, TELEFONO=?, EMAIL=?, DIRECCION=? WHERE CLIENTE_ID=?');
        $stmt->bind_param('sssssi', $nombre, $apellido, $telefono, $email, $direccion, $id);
        $stmt->execute();
    }

    public static function delete(int $id): void
    {
        global $conn;
        $stmt = $conn->prepare('DELETE FROM CLIENTE WHERE CLIENTE_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public static function find(int $id): ?array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM CLIENTE WHERE CLIENTE_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ?: null;
    }

    public static function all(): array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM CLIENTE ORDER BY CLIENTE_ID DESC');
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
