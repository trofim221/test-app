<?php
declare(strict_types=1);

namespace App\Admin\Models;

use App\Core\Model;

class UserEventModel extends Model
{
    private $table = 'user_events';

    public function getReportData(): array
    {
        $sql = "
        SELECT DATE(created_at) as date,
               SUM(CASE WHEN action = 'view-page' AND details = 'page-a' THEN 1 ELSE 0 END) as page_a_views,
               SUM(CASE WHEN action = 'view-page' AND details = 'page-b' THEN 1 ELSE 0 END) as page_b_views,
               SUM(CASE WHEN action = 'button-click' AND details = 'buy-cow' THEN 1 ELSE 0 END) as cow_clicks,
               SUM(CASE WHEN action = 'button-click' AND details = 'download' THEN 1 ELSE 0 END) as download_clicks
        FROM {$this->table}
        GROUP BY DATE(created_at)
        ORDER BY DATE(created_at) DESC
    ";

        return $this->query($sql);
    }

    public function countEvents(): int
    {
        return $this->query("SELECT COUNT(*) as total FROM {$this->table}")[0]['total'] ?? 0;
    }

    public function getRecentEvents(int $limit = 5): array
    {
        $sql = "SELECT user_id, action, details, created_at FROM {$this->table} ORDER BY created_at DESC LIMIT ?";
        return $this->query($sql, [$limit]);
    }
}