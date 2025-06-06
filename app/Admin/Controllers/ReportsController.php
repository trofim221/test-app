<?php
declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Core\Controllers;
use App\Core\View;
use App\Admin\Models\UserEventModel;

class ReportsController extends Controllers
{
    private UserEventModel $eventModel;

    public function __construct(UserEventModel $eventModel)
    {
        $this->eventModel = $eventModel;
    }

    public function index(): void
    {
        $reportData = $this->eventModel->getReportData();

        View::render('admin/reports/index', [
            'reportData' => $reportData
        ]);
    }
}
