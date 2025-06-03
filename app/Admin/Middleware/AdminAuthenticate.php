<?php
namespace App\Admin\Middleware;
use App\Core\Middleware;
use App\Admin\Controllers\AuthController;

class AdminAuthenticate extends Middleware
{

    private $authController;

    public function __construct(AuthController $authController)
    {
        $this->authController = $authController;
    }

    public function handle()
    {
        $currentRoute = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        if (in_array($currentRoute, ['admin/login', 'admin/logout'])) {
            return;
        }

        return $this->authController->checkAdminAccess();

    }

}