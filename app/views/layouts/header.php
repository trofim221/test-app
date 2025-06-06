<?php $isLoggedIn = isset($_SESSION['user']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PC APP STORE™</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand fw-bold" href="/">🌀 PC APP STORE™</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/page-a">Page-A</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/page-b">Page-B</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <?php if ($isLoggedIn): ?>
                <li class="nav-item">
                    <span class="navbar-text me-3">Hello, <?= htmlspecialchars($_SESSION['user']['email']) ?></span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm" href="/user/logout">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm" href="/user/login">Sign In</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>