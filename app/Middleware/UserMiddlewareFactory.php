<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Core\Container;

class UserMiddlewareFactory
{
    public static function auth(Container $container): callable
    {
        return fn() => $container->resolve(UserAuthenticate::class);
    }

    public static function role(string $role): callable
    {
        return fn() => new UserRoleMiddleware($role);
    }

    public static function roles(array $roles): callable
    {
        return fn() => new UserRoleMiddleware($roles);
    }
}
