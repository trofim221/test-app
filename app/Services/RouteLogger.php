<?php

namespace App\Services;

use App\Core\Dispatcher;
use App\Core\Container;
use App\Services\UserActivityService;

class RouteLogger
{
    public function __construct(private Container $container) {}

    public function logRoute($router, $method, $path, $handler, string $action, string $details): void
    {
        $router->$method($path, function () use ($handler, $action, $details) {
            $activity = $this->container->resolve(UserActivityService::class);
            $activity->log($action, $details);

            return (new Dispatcher($this->container))->call($handler);
        });
    }


}
