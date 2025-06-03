<?php $isLoggedIn = isset($_SESSION['user']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PC APP STORE™</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
            font-family: 'Segoe UI', sans-serif;
        }
        .top-bar {
            background-color: black;
            padding: 10px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .auth-card {
            background-color: #1c1c1c;
            color: white;
            max-width: 500px;
            margin: 60px auto;
            padding: 40px;
            text-align: center;
        }
        .auth-card input.form-control {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0;
            color: #fff;
        }
        .auth-card input.form-control::placeholder {
            color: #bbb;
            opacity: 1;
        }
        .btn-gradient {
            background: linear-gradient(to right, red, #a71c40);
            color: white;
            border: none;
            padding: 15px 10px;
            font-weight: bold;
            width: 100%;
            border-radius: 0px;
        }
        .btn-outline-white {
            border: 1px solid white;
            color: white;
            background: none;
        }
    </style>
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