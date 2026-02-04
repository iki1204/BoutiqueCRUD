<?php

declare(strict_types=1);

class ProveedorModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM _CODE_PROVEEDOR ORDER BY PROVEEDOR_ID ASC');
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM _CODE_PROVEEDOR WHERE PROVEEDOR_ID = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO _CODE_PROVEEDOR (PROVEEDOR_ID, NOMBRE_EMPRESA, TELEFONO, EMAIL, DIRECCION, CIUDAD)
             VALUES (:id, :empresa, :telefono, :email, :direccion, :ciudad)'
        );
        $stmt->execute([
            'id' => $data['PROVEEDOR_ID'],
            'empresa' => $data['NOMBRE_EMPRESA'],
            'telefono' => $data['TELEFONO'],
            'email' => $data['EMAIL'],
            'direccion' => $data['DIRECCION'],
            'ciudad' => $data['CIUDAD'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare(
            'UPDATE _CODE_PROVEEDOR
             SET NOMBRE_EMPRESA = :empresa,
                 TELEFONO = :telefono,
                 EMAIL = :email,
                 DIRECCION = :direccion,
                 CIUDAD = :ciudad
             WHERE PROVEEDOR_ID = :id'
        );
        $stmt->execute([
            'id' => $id,
            'empresa' => $data['NOMBRE_EMPRESA'],
            'telefono' => $data['TELEFONO'],
            'email' => $data['EMAIL'],
            'direccion' => $data['DIRECCION'],
            'ciudad' => $data['CIUDAD'],
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM _CODE_PROVEEDOR WHERE PROVEEDOR_ID = :id');
        $stmt->execute(['id' => $id]);
    }

    public function count(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM _CODE_PROVEEDOR');
        return (int) $stmt->fetchColumn();
    }
}
