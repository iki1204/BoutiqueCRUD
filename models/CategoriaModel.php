<?php

declare(strict_types=1);

class CategoriaModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM _CODE_CATEGORIA ORDER BY CATEGORIA_ID ASC');
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM _CODE_CATEGORIA WHERE CATEGORIA_ID = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO _CODE_CATEGORIA (CATEGORIA_ID, CODIGO, DESCRIPCION)
             VALUES (:id, :codigo, :descripcion)'
        );
        $stmt->execute([
            'id' => $data['CATEGORIA_ID'],
            'codigo' => $data['CODIGO'],
            'descripcion' => $data['DESCRIPCION'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare(
            'UPDATE _CODE_CATEGORIA
             SET CODIGO = :codigo,
                 DESCRIPCION = :descripcion
             WHERE CATEGORIA_ID = :id'
        );
        $stmt->execute([
            'id' => $id,
            'codigo' => $data['CODIGO'],
            'descripcion' => $data['DESCRIPCION'],
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM _CODE_CATEGORIA WHERE CATEGORIA_ID = :id');
        $stmt->execute(['id' => $id]);
    }

    public function count(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM _CODE_CATEGORIA');
        return (int) $stmt->fetchColumn();
    }
}
