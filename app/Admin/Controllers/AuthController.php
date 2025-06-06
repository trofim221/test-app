<?php
declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Core\Controllers;
use App\Core\View;
use App\Admin\Models\AdminModel;
use App\Admin\Helpers\Auth;

class AuthController extends Controllers
{
    private AdminModel $adminModel;

    public function __construct(AdminModel $adminModel)
    {
        $this->adminModel = $adminModel;
    }

    public function loginForm(): void
    {
        View::render('admin/auth/login');
    }

    public function login(): void
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->adminModel->validateCredentials($username, $password);

        if ($user) {
            $this->createAuthSession($user);
            $this->redirect('/admin');
        }

        View::render('admin/auth/login', ['error' => 'Invalid credentials']);
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('/admin/login');
    }

    private function createAuthSession(array $user): void
    {
        $permissions = $this->adminModel->getPermissions($user['id']);
        Auth::login($user, $permissions);
    }

    public function checkAdminAccess(): ?array
    {
        $userId = Auth::id();

        if (!$userId || !$this->adminModel->userExists((int)$userId)) {
            $this->redirectToLogin();
        }

        return [
            'user_id' => $userId,
            'username' => Auth::username()
        ];
    }

    private function redirectToLogin(): void
    {
        $this->redirect('/admin/login');
    }

    public function isLoggedIn(): bool
    {
        return Auth::check();
    }
}