<?php
declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Core\Controllers;
use App\Core\View;
use App\Admin\Models\StatisticsModel;

class StatisticsController extends Controllers
{
    private StatisticsModel $statisticsModel;

    public function __construct(StatisticsModel $statisticsModel)
    {
        $this->statisticsModel = $statisticsModel;
    }

    public function index(): void
    {
        $filters = [
            'user_id' => $_GET['user_id'] ?? null,
            'action' => $_GET['action'] ?? null,
            'date' => $_GET['date'] ?? null,
            'details' => $_GET['details'] ?? null,
        ];

        $events = $this->statisticsModel->getFiltered($filters);

        View::render('admin/statistics/index', [
            'events' => $events,
            'filters' => $filters,
        ]);
    }
}