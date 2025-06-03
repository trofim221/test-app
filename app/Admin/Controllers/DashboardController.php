<?php

namespace App\Admin\Controllers;

use App\Core\View;
use App\Admin\Models\UserModel;
use App\Admin\Models\UserEventModel;

class DashboardController
{
    private UserModel $userModel;
    private UserEventModel $eventModel;

    public function __construct(UserModel $userModel, UserEventModel $eventModel)
    {
        $this->userModel = $userModel;
        $this->eventModel = $eventModel;
    }

    public function index()
    {
        $userCount = $this->userModel->countUsers();
        $eventCount = $this->eventModel->countEvents();
        $recentEvents = $this->eventModel->getRecentEvents(5);

        View::render('admin/dashboard/index', compact('userCount', 'eventCount', 'recentEvents'));
    }
}
