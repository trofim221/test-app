<?php
declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

class Model
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    protected function fetchOne(string $sql, array $params = []): ?array
    {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            throw new \RuntimeException("Fetch failed: " . $e->getMessage());
        }
    }

    protected function query(string $sql, array $params = []): array
    {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \RuntimeException("Query failed: " . $e->getMessage());
        }
    }

    protected function execute(string $sql, array $params = []): int
    {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new \RuntimeException("Execute failed: " . $e->getMessage());
        }
    }

    protected function lastInsertId(): string
    {
        return $this->db->lastInsertId();
    }
}
