<?php
namespace App\Admin\Models;

use App\Core\Model;

class UserModel extends Model
{
    private $table = 'users';
    public function countUsers(): int
    {
        return $this->query("SELECT COUNT(*) as total FROM {$this->table}")[0]['total'] ?? 0;
    }

    public function getAllUsers(): array
    {
        $sql = "SELECT id, name, email, created_at FROM {$this->table} ORDER BY created_at DESC";
        return $this->query($sql);
    }


}