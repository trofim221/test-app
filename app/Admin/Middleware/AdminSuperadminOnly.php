<?php
declare(strict_types=1);

namespace App\Admin\Middleware;

use App\Core\View;
use App\Admin\Helpers\Auth;

class AdminSuperadminOnly
{
    public function handle(): void
    {
        if (!Auth::check() || !Auth::isSuperAdmin()) {
            http_response_code(404);
            View::render('errors/404');
            exit;
        }
    }
}