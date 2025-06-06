<?php
declare(strict_types=1);

namespace App\Admin\Middleware;

use App\Core\Container;

class MiddlewareFactory
{
    public static function auth(Container $container): callable
    {
        return fn() => $container->resolve(AdminAuthenticate::class);
    }

    public static function superadmin(Container $container): callable
    {
        return fn() => $container->resolve(AdminSuperadminOnly::class);
    }

    public static function permission(string $permission): callable
    {
        return fn() => new AdminPermission($permission);
    }
}

