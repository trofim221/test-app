<?php
namespace App\Admin\Controllers;

use App\Core\Controllers;
use App\Core\View;
use App\Admin\Models\AdminModel;
class AuthController extends Controllers
{
    private $adminModel;
    public function __construct(AdminModel $adminModel)
    {
        $this->adminModel = $adminModel;
    }

    public function loginForm()
    {
        View::render('admin/auth/login');
    }

    public function login()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->adminModel->validateCredentials($username, $password);

        if ($user) {
            $this->createAuthSession($user);
            $this->redirect('/admin');
        }

        View::render('admin/auth/login', ['error' => 'Невірні облікові дані']);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->redirect('/admin/login');
    }

    private function createAuthSession(array $user): void
    {
        $permissions = $this->adminModel->getPermissions($user['id']);

        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['is_superadmin'] = (bool) $user['is_superadmin'];
        $_SESSION['admin_permissions'] = $permissions;
    }

    public function checkAdminAccess(): ?array
    {
        if (!isset($_SESSION['admin_id'])) {
            $this->redirectToLogin();
        }

        $user = $this->adminModel->userExists((int)$_SESSION['admin_id']);

        if (!$user) {
            $this->redirectToLogin();
        }

        return [
            'user_id' => $_SESSION['admin_id'],
            'username' => $_SESSION['admin_username']
        ];
    }

    private function redirectToLogin(): void
    {
        $this->redirect('/admin/login');
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['admin_id']);
    }

}