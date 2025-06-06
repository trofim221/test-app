<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Controllers\UserAuthController;
use App\Core\Middleware;

class UserAuthenticate extends Middleware
{
    private UserAuthController $authController;

    public function __construct(UserAuthController $authController)
    {
        $this->authController = $authController;
    }

    public function handle()
    {
        $this->authController->checkUserAccess();
    }
}
