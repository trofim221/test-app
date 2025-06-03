<?php

namespace App\Admin\Builders;

class AdminBuilder
{
    private array $data = [
        'username' => '',
        'email' => '',
        'password' => '',
        'is_superadmin' => 0,
        'permissions' => [],
    ];

    public function setUsername(string $username): self
    {
        $this->data['username'] = $username;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->data['email'] = $email;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->data['password'] = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function setIsSuperAdmin(bool $isSuperAdmin): self
    {
        $this->data['is_superadmin'] = $isSuperAdmin ? 1 : 0;
        return $this;
    }

    public function addPermission(string $permission): self
    {
        $this->data['permissions'][] = $permission;
        return $this;
    }

    public function setPermissions(array $permissions): self
    {
        if ($this->data['is_superadmin']) {
            $this->data['permissions'] = [];
        } else {
            $this->data['permissions'] = $permissions;
        }
        return $this;
    }


    public function build(): array
    {
        return $this->data;
    }

}