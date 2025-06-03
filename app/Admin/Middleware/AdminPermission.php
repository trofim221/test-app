<?php

namespace App\Admin\Middleware;
use App\Core\View;

class AdminPermission
{
    private string $requiredPermission;

    public function __construct(string $permission)
    {
        $this->requiredPermission = $permission;
    }

    public function handle()
    {
        $isSuperadmin = $_SESSION['is_superadmin'] ?? false;
        $permissions = $_SESSION['admin_permissions'] ?? [];

        if (!$isSuperadmin && !in_array($this->requiredPermission, $permissions)) {
            http_response_code(404);
            View::render('errors/404');
            exit;
        }
    }
}