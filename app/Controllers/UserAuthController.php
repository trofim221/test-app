<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controllers;
use App\Core\View;
use App\Services\UserAuthService;
use App\Helpers\UserAuth;

class UserAuthController extends Controllers
{
    private UserAuthService $authService;

    public function __construct(UserAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function loginForm(): void
    {
        if (UserAuth::check()) {
            $this->redirect('/page-a');
        }

        $message = null;
        if (isset($_GET['success'])) {
            $message = 'Registration is successful! You can now log in.';
        }

        View::render('user/login', ['message' => $message]);
    }


    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->authService->login($email, $password)) {
            $this->redirect('/page-a');
        }

        View::render('user/login', ['error' => 'Invalid email or password']);
    }

    public function logout(): void
    {
        UserAuth::logout();
        $this->redirect('/user/login');
        exit;
    }

    public function registerForm(): void
    {
        if (UserAuth::check()) {
            $this->redirect('/page-a');
        }
        View::render('user/register');
    }

    public function register(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $name = $_POST['username'] ?? '';

        if ($this->authService->register($email, $password, $name)) {
            $this->redirect('/user/login?success=1');
        }

        View::render('user/register', ['error' => 'Enter your email and password']);
    }

    public function checkUserAccess(): ?array
    {
        if (!UserAuth::check()) {
            $this->redirect('/user/login');
        }
        return UserAuth::user();
    }

    public function isLoggedIn(): bool
    {
        return UserAuth::check();
    }
}
