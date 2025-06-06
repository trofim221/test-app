<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{
    private $table = 'users';
    public function register(string $email, string $password, string $name): void
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $this->execute(
            "INSERT INTO {$this->table} (email, password, name, role) VALUES (:email, :password, :name, :role)",
            [':email' => $email, ':password' => $hashed, ':name' => $name, ':role' => 'basic']
        );

        $userId = $this->lastInsertId();
        $this->execute(
            "INSERT INTO user_events (user_id, action) VALUES (:user_id, 'registration')",
            [':user_id' => $userId]
        );
    }

    public function findByEmail(string $email): ?array
    {
        return $this->fetchOne("SELECT * FROM {$this->table} WHERE email = :email", [':email' => $email]);
    }

    public function findById(int $id): ?array
    {
        return $this->fetchOne("SELECT * FROM {$this->table} WHERE id = :id", [':id' => $id]);
    }
}