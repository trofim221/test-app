<?php
namespace App\Controllers;

use App\Core\Controllers;
use App\Core\View;
use App\Models\UserModel;
use App\Services\UserActivityService;

class UserAuthController extends Controllers
{
    private UserModel $userModel;
    private UserActivityService $activity;
    public function __construct(UserModel $userModel, UserActivityService $activity)
    {
        $this->userModel = $userModel;
        $this->activity = $activity;
    }

    public function loginForm()
    {
        $this->activity->log('login');

        $this->redirectIfAuthenticated();

        $message = null;
        if (isset($_GET['success'])) {
            $message = 'Registration is successful! You can now log in.';
        }

        View::render('user/login', ['message' => $message]);
    }

    public function login()
    {

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {

            $this->createUserSession($user);
            $this->redirect('/page-a');
        }

        View::render('user/login', ['error' => 'Invalid email or password']);
    }

    public function logout():void
    {
        $this->activity->log('logout');
        session_unset();
        session_destroy();
        $this->redirect('/user/login');
    }

    public function registerForm():void
    {
        $this->activity->log('registration');

        $this->redirectIfAuthenticated();
        View::render('user/register');
    }

    public function register()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $name = $_POST['username'] ?? '';

        if ($email && $password) {
            $this->userModel->register($email, $password, $name);
            $this->redirect('/user/login?success=1');
        }

        View::render('user/register', ['error' => 'Enter your email and password']);
    }

    private function createUserSession(array $user): void
    {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role'] ?? 'basic'
        ];
    }

    public function checkUserAccess(): ?array
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/user/login');
        }

        return $_SESSION['user'];
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    private function redirectIfAuthenticated(): void
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('/page-a');
        }
    }

}
