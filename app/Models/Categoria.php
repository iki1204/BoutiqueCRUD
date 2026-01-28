<?php
class Categoria
{
    public static function create(int $id, string $nombre, string $descripcion): void
    {
        global $conn;
        $stmt = $conn->prepare('INSERT INTO CATEGORIA (CATEGORIA_ID, NOMBRE, DESCRIPCION) VALUES (?,?,?)');
        $stmt->bind_param('iss', $id, $nombre, $descripcion);
        $stmt->execute();
    }

    public static function update(int $id, string $nombre, string $descripcion): void
    {
        global $conn;
        $stmt = $conn->prepare('UPDATE CATEGORIA SET NOMBRE=?, DESCRIPCION=? WHERE CATEGORIA_ID=?');
        $stmt->bind_param('ssi', $nombre, $descripcion, $id);
        $stmt->execute();
    }

    public static function delete(int $id): void
    {
        global $conn;
        $stmt = $conn->prepare('DELETE FROM CATEGORIA WHERE CATEGORIA_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public static function find(int $id): ?array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM CATEGORIA WHERE CATEGORIA_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ?: null;
    }

    public static function all(): array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM CATEGORIA ORDER BY CATEGORIA_ID DESC');
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
