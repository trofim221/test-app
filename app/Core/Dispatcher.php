<?php
declare(strict_types=1);

namespace App\Core;

class Dispatcher
{
    public function __construct(private Container $container)
    {
    }

    public function call(string $handler): mixed
    {
        [$controllerClass, $method] = explode('@', $handler);

        $controller = $this->container->resolve($controllerClass);

        if (!method_exists($controller, $method)) {
            throw new \Exception("Method {$method} not found in {$controllerClass}");
        }

        return call_user_func([$controller, $method]);
    }
}