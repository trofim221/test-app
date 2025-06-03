<?php

namespace App\Admin\Controllers;
use App\Core\View;
use App\Admin\Models\UserModel;
class UsersController
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
        $users = $this->userModel->getAllUsers();
        View::render('admin/users/index', ['users' => $users]);

    }

}