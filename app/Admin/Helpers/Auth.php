<?php
declare(strict_types=1);

namespace App\Admin\Helpers;

class Auth
{
    public static function id(): ?int
    {
        return $_SESSION['admin_id'] ?? null;
    }

    public static function username(): ?string
    {
        return $_SESSION['admin_username'] ?? null;
    }

    public static function isSuperAdmin(): bool
    {
        return $_SESSION['is_superadmin'] ?? false;
    }

    public static function permissions(): array
    {
        return $_SESSION['admin_permissions'] ?? [];
    }

    public static function check(): bool
    {
        return isset($_SESSION['admin_id']);
    }

    public static function login(array $user, array $permissions): void
    {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['is_superadmin'] = (bool)$user['is_superadmin'];
        $_SESSION['admin_permissions'] = $permissions;
    }

    public static function logout(): void
    {
        session_unset();
        session_destroy();
    }
}
