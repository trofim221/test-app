<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\UserModel;
use App\Helpers\UserAuth;

class UserAuthService
{
    public function __construct(private UserModel $userModel) {}

    public function login(string $email, string $password): bool
    {
        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            UserAuth::login($user);
            return true;
        }

        return false;
    }

    public function register(string $email, string $password, string $name): bool
    {
        if (!$email || !$password) {
            return false;
        }

        $this->userModel->register($email, $password, $name);
        return true;
    }
}
