<?php
declare(strict_types=1);

namespace App\Core;

class Router
{
    protected $routes = ['GET' => [], 'POST' => []];
    protected $currentMiddleware = null;

    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function get($pattern, $controller)
    {
        $this->addRoute('GET', $pattern, $controller);
    }

    public function post($pattern, $controller)
    {
        $this->addRoute('POST', $pattern, $controller);
    }

    public function middleware($middleware, $callback)
    {
        $this->currentMiddleware = $middleware;
        $callback($this);
        $this->currentMiddleware = null;
    }

    protected function addRoute($method, $pattern, $controller)
    {
        $route = [
            'pattern' => $this->convertPattern($pattern),
            'controller' => $controller,
            'middleware' => $this->currentMiddleware
        ];

        $this->routes[$method][] = $route;
    }

    protected function show404()
    {
        http_response_code(404);
        View::render('/errors/404');
    }

    public function dispatch($uri, $method)
    {
        $uri = trim(parse_url($uri, PHP_URL_PATH), '/');

        foreach ($this->routes[$method] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                array_shift($matches);

                // Apply middleware through container
                if ($route['middleware']) {
                    $middleware = is_callable($route['middleware'])
                        ? call_user_func($route['middleware'])
                        : $this->container->resolve($route['middleware']);

                    $middleware->handle();
                }


                return $this->callAction($route['controller'], $matches);
            }
        }

        http_response_code(404);
        $this->show404();
    }

    protected function callAction($controllerAction, $params = [])
    {
        if (is_callable($controllerAction)) {
            return call_user_func_array($controllerAction, $params);
        }

        if (is_array($controllerAction)) {
            [$controllerClass, $method] = $controllerAction;
        } elseif (is_string($controllerAction) && str_contains($controllerAction, '@')) {
            [$controller, $method] = explode('@', $controllerAction);

            $controllerClass = str_replace('/', '\\', $controller);
        } else {
            throw new \Exception("Invalid route definition.");
        }

        if (!class_exists($controllerClass)) {
            throw new \Exception("Controller $controllerClass not found.");
        }

        $instance = $this->container->resolve($controllerClass);

        if (!method_exists($instance, $method)) {
            throw new \Exception("Method $method not found in controller $controllerClass.");
        }

        return call_user_func_array([$instance, $method], $params);
    }

    protected function convertPattern($pattern)
    {
        return '#^' . preg_replace('#\{([a-zA-Z_]+)\}#', '([^/]+)', trim($pattern, '/')) . '$#';
    }
}