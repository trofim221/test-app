<?php
$currentPath = $_SERVER['REQUEST_URI'];
$isSuperadmin = $_SESSION['is_superadmin'] ?? false;
$permissions = $_SESSION['admin_permissions'] ?? [];
function can(string $permission): bool {
    $isSuperadmin = $_SESSION['is_superadmin'] ?? false;
    $permissions = $_SESSION['admin_permissions'] ?? [];

    return $isSuperadmin || in_array($permission, $permissions);
}

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC APP Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/app/views/admin/assets/css/style.css?=<?=time();?>">
</head>
<body>
<!-- Бокове меню зліва -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">

        <h3 class="mb-0">🌀Admin</h3>
        <button class="btn btn-dark btn-sm ms-auto d-lg-none" id="sidebarClose">
            <i class="bi bi-x"></i>
        </button>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="/admin/" class="<?= $currentPath === '/admin/' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <?php if (can('view_statistics')): ?>
            <li>
                <a href="/admin/statistics" class="<?= str_starts_with($currentPath, '/admin/statistics') ? 'active' : '' ?>">
                    <i class="bi bi-graph-up-arrow"></i> Statistics
                </a>
            </li>
        <?php endif; ?>

        <?php if (can('view_reports')): ?>
            <li>
                <a href="/admin/reports" class="<?= str_starts_with($currentPath, '/admin/reports') ? 'active' : '' ?>">
                    <i class="bi bi-file-earmark-bar-graph"></i> Reports
                </a>
            </li>
        <?php endif; ?>

        <?php if (can('view_users')): ?>
            <li>
                <a href="/admin/users" class="<?= str_starts_with($currentPath, '/admin/users') ? 'active' : '' ?>">
                    <i class="bi bi-people"></i> Users
                </a>
            </li>
        <?php endif; ?>

        <?php if ($isSuperadmin): ?>
            <li>
                <a href="/admin/manage-admins" class="<?= str_starts_with($currentPath, '/admin/manage-admins') ? 'active' : '' ?>">
                    <i class="bi bi-shield-lock"></i> Administrators
                </a>
            </li>
        <?php endif; ?>

        <li class="mt-4">
            <a href="/admin/logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </li>
    </ul>
</div>

<!-- Основний контент -->
<div class="main-content" id="mainContent">
    <!-- Верхня навігаційна панель -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="btn btn-dark d-lg-none" type="button" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <div class="d-flex align-items-center ms-auto">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/app/views/admin/assets/img/avatar.svg" width="36" alt="Admin" class="rounded-circle me-2">
                        <span>Admin</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/admin/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>