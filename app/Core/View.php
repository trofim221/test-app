<?php
declare(strict_types=1);

namespace App\Core;

class View
{
    private static string $basePath = '';

    public static function setBasePath(string $path): void
    {
        self::$basePath = rtrim($path, '/') . '/';
    }

    /**
     * @throws \Exception
     */
    public static function render($view, $data = []): void
    {
        extract($data);
        $viewPath = self::$basePath . $view . '.php';

        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            throw new \Exception("View not found: $viewPath");
        }
    }
}
