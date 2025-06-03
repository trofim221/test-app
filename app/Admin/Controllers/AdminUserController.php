<?php
namespace App\Admin\Controllers;

use App\Admin\Builders\AdminBuilder;
use App\Core\Controllers;
use App\Core\View;
use App\Admin\Models\AdminModel;

class AdminUserController extends Controllers
{
    private AdminModel $adminModel;
    private AdminBuilder $adminBuilder;

    public function __construct(AdminModel $adminModel, AdminBuilder $adminBuilder)
    {
        $this->adminModel = $adminModel;
        $this->adminBuilder = $adminBuilder;
    }

    public function index()
    {
        $admins = $this->adminModel->getAll();
        View::render('admin/manage_admins/index', ['admins' => $admins]);
    }

    public function create()
    {
        View::render('admin/manage_admins/create');
    }

    public function store()
    {
        $this->adminBuilder
            ->setUsername($_POST['username'] ?? '')
            ->setEmail($_POST['email'] ?? '')
            ->setPassword($_POST['password'] ?? '')
            ->setIsSuperAdmin(isset($_POST['is_superadmin']));

        foreach ($_POST['permissions'] ?? [] as $perm) {
            $this->adminBuilder->addPermission($perm);
        }

        $adminData = $this->adminBuilder->build();

        $this->adminModel->createAdmin($adminData);

        $this->redirect('/admin/manage-admins');
    }

    public function edit($id)
    {

        $admin = $this->adminModel->getById((int)$id);
        $admin['permissions'] = $this->adminModel->getPermissions((int)$id);

        View::render('admin/manage_admins/edit', [
            'admin' => $admin
        ]);
    }

    public function update($id)
    {

        $this->adminBuilder
            ->setUsername($_POST['username'] ?? '')
            ->setEmail($_POST['email'] ?? '')
            ->setIsSuperAdmin(isset($_POST['is_superadmin']))
            ->setPermissions($_POST['permissions'] ?? []);

        if (!empty($_POST['password'])) {
            $this->adminBuilder->setPassword($_POST['password']);
        }

        $adminData = $this->adminBuilder->build();

        $this->adminModel->updateAdmin((int)$id, $adminData, $adminData['permissions']);

        $this->redirect('/admin/manage-admins');
    }

    public function delete($id)
    {
        $this->adminModel->deleteById((int)$id);

        $this->redirect('/admin/manage-admins');
    }


}