<?php
declare(strict_types=1);

namespace App\Admin\Middleware;

use App\Core\View;
use App\Admin\Helpers\Auth;

class AdminPermission
{
    private string $requiredPermission;

    public function __construct(string $permission)
    {
        $this->requiredPermission = $permission;
    }

    public function handle(): void
    {
        $isSuperadmin = Auth::isSuperAdmin();
        $permissions = Auth::permissions();

        if (!$isSuperadmin && !in_array($this->requiredPermission, $permissions)) {
            http_response_code(404);
            View::render('errors/404');
            exit;
        }
    }
}