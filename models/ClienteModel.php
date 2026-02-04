<?php

declare(strict_types=1);

class ClienteModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM _CODE_CLIENTE ORDER BY CLIENTE_ID ASC');
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM _CODE_CLIENTE WHERE CLIENTE_ID = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO _CODE_CLIENTE (CLIENTE_ID, CODIGO, APELLIDO, TELEFONO, EMAIL, DIRECCION)
             VALUES (:id, :codigo, :apellido, :telefono, :email, :direccion)'
        );
        $stmt->execute([
            'id' => $data['CLIENTE_ID'],
            'codigo' => $data['CODIGO'],
            'apellido' => $data['APELLIDO'],
            'telefono' => $data['TELEFONO'],
            'email' => $data['EMAIL'],
            'direccion' => $data['DIRECCION'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare(
            'UPDATE _CODE_CLIENTE
             SET CODIGO = :codigo,
                 APELLIDO = :apellido,
                 TELEFONO = :telefono,
                 EMAIL = :email,
                 DIRECCION = :direccion
             WHERE CLIENTE_ID = :id'
        );
        $stmt->execute([
            'id' => $id,
            'codigo' => $data['CODIGO'],
            'apellido' => $data['APELLIDO'],
            'telefono' => $data['TELEFONO'],
            'email' => $data['EMAIL'],
            'direccion' => $data['DIRECCION'],
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM _CODE_CLIENTE WHERE CLIENTE_ID = :id');
        $stmt->execute(['id' => $id]);
    }

    public function count(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM _CODE_CLIENTE');
        return (int) $stmt->fetchColumn();
    }
}
