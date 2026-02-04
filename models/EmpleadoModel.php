<?php

declare(strict_types=1);

class EmpleadoModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM _CODE_EMPLEADO ORDER BY EMPLEADO_ID ASC');
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM _CODE_EMPLEADO WHERE EMPLEADO_ID = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            'INSERT INTO _CODE_EMPLEADO (EMPLEADO_ID, CODIGO, APELLIDO, CARGO, TELEFONO, DIRECCION, FECHA_INGRESO)
             VALUES (:id, :codigo, :apellido, :cargo, :telefono, :direccion, :fecha)'
        );
        $stmt->execute([
            'id' => $data['EMPLEADO_ID'],
            'codigo' => $data['CODIGO'],
            'apellido' => $data['APELLIDO'],
            'cargo' => $data['CARGO'],
            'telefono' => $data['TELEFONO'],
            'direccion' => $data['DIRECCION'],
            'fecha' => $data['FECHA_INGRESO'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare(
            'UPDATE _CODE_EMPLEADO
             SET CODIGO = :codigo,
                 APELLIDO = :apellido,
                 CARGO = :cargo,
                 TELEFONO = :telefono,
                 DIRECCION = :direccion,
                 FECHA_INGRESO = :fecha
             WHERE EMPLEADO_ID = :id'
        );
        $stmt->execute([
            'id' => $id,
            'codigo' => $data['CODIGO'],
            'apellido' => $data['APELLIDO'],
            'cargo' => $data['CARGO'],
            'telefono' => $data['TELEFONO'],
            'direccion' => $data['DIRECCION'],
            'fecha' => $data['FECHA_INGRESO'],
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM _CODE_EMPLEADO WHERE EMPLEADO_ID = :id');
        $stmt->execute(['id' => $id]);
    }

    public function count(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM _CODE_EMPLEADO');
        return (int) $stmt->fetchColumn();
    }
}
