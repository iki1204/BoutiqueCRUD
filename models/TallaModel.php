<?php

declare(strict_types=1);

class TallaModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM _CODE_TALLA ORDER BY TALLA_ID ASC');
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM _CODE_TALLA WHERE TALLA_ID = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO _CODE_TALLA (TALLA_ID, CODIGO, DESCRIPCION)
             VALUES (:id, :codigo, :descripcion)'
        );
        $stmt->execute([
            'id' => $data['TALLA_ID'],
            'codigo' => $data['CODIGO'],
            'descripcion' => $data['DESCRIPCION'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare(
            'UPDATE _CODE_TALLA
             SET CODIGO = :codigo,
                 DESCRIPCION = :descripcion
             WHERE TALLA_ID = :id'
        );
        $stmt->execute([
            'id' => $id,
            'codigo' => $data['CODIGO'],
            'descripcion' => $data['DESCRIPCION'],
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM _CODE_TALLA WHERE TALLA_ID = :id');
        $stmt->execute(['id' => $id]);
    }

    public function count(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM _CODE_TALLA');
        return (int) $stmt->fetchColumn();
    }
}
