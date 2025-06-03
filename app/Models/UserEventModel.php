<?php

namespace App\Models;

use App\Core\Model;

class UserEventModel extends Model
{
    private $table = 'user_events';
    public function log(string $action, string $details = '', ?int $userId = null): void
    {
        $userId = $userId ?? ($_SESSION['user']['id'] ?? null);

        $sql = "INSERT INTO {$this->table} (user_id, action, details) 
            VALUES (:user_id, :action, :details)";

        $this->execute($sql, [
            'user_id' => $userId,
            'action' => $action,
            'details' => $details
        ]);
    }

    public function getAll(): array
    {
        return $this->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
    }

}