<?php

namespace App\Services;
use App\Models\UserEventModel;
class UserActivityService
{
    private UserEventModel $eventModel;

    public function __construct(UserEventModel $eventModel)
    {
        $this->eventModel = $eventModel;
    }

    public function log(string $action, string $details = ''): void
    {
        $this->eventModel->log($action, $details);
    }
}