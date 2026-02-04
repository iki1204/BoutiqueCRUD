<?php

declare(strict_types=1);

class GenericModel
{
    protected PDO $db;
    protected string $table;
    protected string $primaryKey;
    protected array $fields;

    public function __construct(string $table, string $primaryKey, array $fields)
    {
        $this->db = Database::getConnection();
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->fields = $fields;
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY {$this->primaryKey} ASC");
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function create(array $data): int
    {
        $columns = implode(', ', $this->fields);
        $placeholders = implode(', ', array_map(fn ($field) => ':' . $field, $this->fields));
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})");
        $payload = [];
        foreach ($this->fields as $field) {
            $payload[$field] = $data[$field] ?? null;
        }
        $stmt->execute($payload);

        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $assignments = implode(', ', array_map(fn ($field) => "$field = :$field", $this->fields));
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET {$assignments} WHERE {$this->primaryKey} = :id"
        );
        $payload = ['id' => $id];
        foreach ($this->fields as $field) {
            $payload[$field] = $data[$field] ?? null;
        }
        $stmt->execute($payload);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $stmt->execute(['id' => $id]);
    }

    public function count(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM {$this->table}");
        return (int) $stmt->fetchColumn();
    }
}
