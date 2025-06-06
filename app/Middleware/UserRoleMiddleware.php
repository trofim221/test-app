<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Core\Middleware;

class UserRoleMiddleware extends Middleware
{
    private string $requiredRole;

    public function __construct(string $requiredRole)
    {
        $this->requiredRole = $requiredRole;
    }

    public function handle(): void
    {
        $this->checkLogin();
        $this->checkRoleMatch();
    }

    private function checkLogin(): void
    {
        if (!isset($_SESSION['user_id'], $_SESSION['user_role'])) {
            http_response_code(403);
            echo "Access Denied (not logged in)";
            exit;
        }
    }

    private function checkRoleMatch(): void
    {
        if ($_SESSION['user_role'] !== $this->requiredRole) {
            http_response_code(403);
            echo "Access Denied (role mismatch)";
            exit;
        }
    }
}
