<?php
namespace App\Admin\Middleware;
use App\Core\View;

class AdminSuperadminOnly
{
    public function handle()
    {
        if (empty($_SESSION['admin_id']) || empty($_SESSION['is_superadmin']) || $_SESSION['is_superadmin'] !== true) {
            http_response_code(404);
            View::render('errors/404');
            exit;
        }
    }
}