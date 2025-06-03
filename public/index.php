<?php
// Start session and show all errors (for debugging)
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load Composer autoload
require_once "../vendor/autoload.php";

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Import required classes
use App\Core\Router;
use App\Core\Container;
use App\Core\View;
use App\Admin\Middleware\MiddlewareFactory;
use App\Middleware\UserMiddlewareFactory;

// Set base path for views
View::setBasePath(__DIR__ . '/../app/views');

// Initialize service container and router
$container = new Container();
$router = new Router($container);

// User authentication routes
$router->get('/user/register', 'App\Controllers\UserAuthController@registerForm');
$router->post('/user/register', 'App\Controllers\UserAuthController@register');
$router->get('/user/login', 'App\Controllers\UserAuthController@loginForm');
$router->post('/user/login', 'App\Controllers\UserAuthController@login');
$router->get('/user/logout', 'App\Controllers\UserAuthController@logout');

// Public pages
$router->get('/', 'App\Controllers\HomeController@index');
$router->get('/page-b', 'App\Controllers\PageController@pageB');
$router->get('/download', 'App\Controllers\PageController@download');

// Protected user pages
$router->middleware(UserMiddlewareFactory::auth($container), function () use ($router) {
    $router->get('/page-a', 'App\Controllers\PageController@pageA');
    $router->post('/buy-cow', 'App\Controllers\PageController@buyCow');
});

// Admin login/logout routes
$router->get('/admin/login', 'App\Admin\Controllers\AuthController@loginForm');
$router->post('/admin/login', 'App\Admin\Controllers\AuthController@login');
$router->get('/admin/logout', 'App\Admin\Controllers\AuthController@logout');

// Admin panel routes with middleware protection
$router->middleware(MiddlewareFactory::auth($container), function () use ($router, $container) {
    $router->get('/admin', 'App\Admin\Controllers\DashboardController@index');

    // View statistics permission
    $router->middleware(MiddlewareFactory::permission('view_statistics'), function () use ($router) {
        $router->get('/admin/statistics', 'App\Admin\Controllers\StatisticsController@index');
    });

    // View reports permission
    $router->middleware(MiddlewareFactory::permission('view_reports'), function () use ($router) {
        $router->get('/admin/reports', 'App\Admin\Controllers\ReportsController@index');
    });

    // View users permission
    $router->middleware(MiddlewareFactory::permission('view_users'), function () use ($router) {
        $router->get('/admin/users', 'App\Admin\Controllers\UsersController@index');
    });

    // Superadmin-only routes
    $router->middleware(MiddlewareFactory::superadmin($container), function () use ($router) {
        $router->get('/admin/manage-admins', 'App\Admin\Controllers\AdminUserController@index');
        $router->get('/admin/manage-admins/create', 'App\Admin\Controllers\AdminUserController@create');
        $router->post('/admin/manage-admins/store', 'App\Admin\Controllers\AdminUserController@store');
        $router->get('/admin/manage-admins/edit/{id}', 'App\Admin\Controllers\AdminUserController@edit');
        $router->post('/admin/manage-admins/update/{id}', 'App\Admin\Controllers\AdminUserController@update');
        $router->get('/admin/manage-admins/delete/{id}', 'App\Admin\Controllers\AdminUserController@delete');
    });
});

// Get current request and dispatch to appropriate route
$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$router->dispatch($request, $_SERVER['REQUEST_METHOD']);
