<?php
declare(strict_types=1);

namespace App\Admin\Models;

use App\Core\Model;

class AdminModel extends Model
{
    private $table = 'admin_users';

    public function validateCredentials(string $username, string $password): ?array
    {
        $user = $this->fetchOne(
            "SELECT * FROM {$this->table} WHERE username = :username LIMIT 1",
            [':username' => $username]
        );

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }

    public function userExists(int $userId): bool
    {
        $result = $this->fetchOne(
            "SELECT id FROM {$this->table} WHERE id = :id LIMIT 1",
            [':id' => $userId]
        );

        return $result !== null;
    }

    public function isSuperAdmin(int $adminId): bool
    {
        $user = $this->fetchOne(
            "SELECT is_superadmin FROM {$this->table} WHERE id = :id LIMIT 1",
            [':id' => $adminId]
        );

        return $user && (int)$user['is_superadmin'] === 1;
    }

    public function getAll(): array
    {
        return $this->query(
            "SELECT id, username, email, is_superadmin, created_at FROM {$this->table} ORDER BY id DESC"
        );
    }

    public function createAdmin(array $admin): void
    {
        $fields = ['username', 'email', 'password', 'is_superadmin'];
        $columns = implode(', ', $fields);
        $placeholders = ':' . implode(', :', $fields);

        $params = [];
        foreach ($fields as $field) {
            $params[":$field"] = $admin[$field] ?? null;
        }

        $this->execute(
            "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)",
            $params
        );

        $adminId = (int)$this->db->lastInsertId();

        $this->assignPermissions($adminId, $admin['permissions'] ?? []);
    }

    public function getById(int $id): ?array
    {
        return $this->fetchOne("SELECT * FROM {$this->table} WHERE id = :id", [':id' => $id]);
    }

    public function updateAdmin(int $id, array $data, array $permissions): void
    {
        $fields = [];
        $params = [':id' => $id];

        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
            $params[":$key"] = $value;
        }

        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = :id";
        $this->execute($sql, $params);

        $this->execute("DELETE FROM admin_permissions WHERE admin_id = :id", [':id' => $id]);
        $this->assignPermissions($id, $permissions);
    }

    public function deleteById(int $id): void
    {
        $this->execute("DELETE FROM {$this->table} WHERE id = :id", [':id' => $id]);
    }

    public function getPermissions(int $adminId): array
    {
        $rows = $this->query(
            "SELECT permission_key FROM admin_permissions WHERE admin_id = :admin_id",
            [':admin_id' => $adminId]
        );

        return array_column($rows, 'permission_key');
    }

    public function assignPermissions(int $adminId, array $permissions): void
    {
        foreach ($permissions as $key) {
            $this->execute(
                "INSERT INTO admin_permissions (admin_id, permission_key) VALUES (:admin_id, :key)",
                [
                    ':admin_id' => $adminId,
                    ':key' => $key
                ]
            );
        }
    }

}