<?php
namespace App\Admin\Models;

use App\Core\Model;

class StatisticsModel extends Model
{
    private $table = 'user_events';
    public function getFiltered(array $filters = []): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];

        if (!empty($filters['user_id'])) {
            $sql .= " AND user_id = :user_id";
            $params[':user_id'] = $filters['user_id'];
        }

        if (!empty($filters['action'])) {
            $sql .= " AND action = :action";
            $params[':action'] = $filters['action'];
        }

        if (!empty($filters['date'])) {
            $sql .= " AND DATE(created_at) = :date";
            $params[':date'] = $filters['date'];
        }

        $sql .= " ORDER BY created_at DESC";

        return $this->query($sql, $params);
    }
}