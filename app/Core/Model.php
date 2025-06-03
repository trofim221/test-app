<?php
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

    /**
     * Execute a SELECT query and return the first result row.
     */
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

    /**
     * Execute a SELECT query and return all result rows.
     */
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


    /**
     * Execute an INSERT, UPDATE, or DELETE query.
     */
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

    /**
     * Get the ID of the last inserted row.
     *
     * @return string The last inserted ID.
     */
    protected function lastInsertId(): string
    {
        return $this->db->lastInsertId();
    }

}
